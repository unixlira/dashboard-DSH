<?php 
namespace App\Http\Controllers; //obrigatorio a definicao do namespace do diretorio q contem AS classes q vamos extender

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\AfazeresRequest; //classe de validacao
use App\Http\Requests\UsuarioRequest; //classe de validacao
use App\Http\Controllers\Controller; //chamando a classe extendida
use Illuminate\Support\Facades\DB; //classe de comunicacao com o BD
use Yajra\Datatables\Datatables;
use View;
use App\Afazeres;
use App\Usuarios;

class IndexController extends Controller
{
	public function __construct()
    {
        $this->middleware('autorizador'); //invocamos o middleware q verifica o login
    }
	
	public function showView($name)
    {
        if(View::exists($name)){
            return view($name);
        }
        else{
            return view('404');
        }
    }

    // -- CONTROLE DOS AFAZERES-- //
    public function insereAfazer(AfazeresRequest $request){ //salvando novo
		$afazer = new Afazeres; 
		$afazer->texto = $request->texto;
		$afazer->id_usuario = \Request::session()->get('id_usuario');
		$afazer->save();
		return redirect('/');
	}

	public function removeAfazer($id){ //removendo afazer
		$afazer = Afazeres::find($id); 
		if ($afazer) {
			$afazer->delete();
		}
		return redirect('/');
	}

	public function atualizaAfazer(AfazeresRequest $request, $id){ //atualizando
		$afazer_Atualizar = Afazeres::find($id); //pegando o produto a atualizar
		$afazer_Atualizar->texto = $request->afazerAtualizado;

		$update = $afazer_Atualizar->save(); //atualizando
		//redirecionando de acordo com o resultado do update
		return redirect('/'); 
	}

	public function salvaNotas(UsuarioRequest $request){ //atualizando
		$usuario = Usuarios::find(\Request::session()->get('id_usuario')); //pegando o produto a atualizar
		$usuario->notas = $request->notas;

		$update = $usuario->save(); //atualizando
		//redirecionando de acordo com o resultado do update
		return redirect('/'); 
	}

	public function acoesRecentes()
	{
		return view('acoesrecentes');
	}

	public function getAcoesRecentes()
    {
		$files = DB::select('SELECT a.*, b.nome FROM acoes_recentes a, usuarios b WHERE a.id_usuario = b.id;');
		return Datatables::of($files)->make(true);
    }

	// -- FIM DOS AFAZERES -- //

	// -- CARREGEMENTOS AJAX DA PAGINA INICIAL -- //

	public function carregaQuadradinhos(){ //Quadradinhos superior esquerdo
		//quantidade de spins disponibilizados
		$spinsDisponibilizados = DB::select('SELECT SUM(qtde_spins) AS qtde_spins FROM compras_clientes');
		//quantidade de spins realizados
		$spinsRealizados = DB::select('SELECT (SUM(qtde_spins) - SUM(saldo_spins)) AS spins_realizados FROM compras_clientes');
		//quantidade de participantes
		$totalParticipantes = DB::select('SELECT COUNT(*) AS total_participantes FROM participantes');
		//quantidade total de cupons resgatados
		$totalCuponsResgatados = DB::select('SELECT COUNT(*) AS total_cupons_resgatados FROM cupom_compras WHERE status_cupom =1');
		//Andamento da distribuição da pontuação:
		$pontos = DB::select('SELECT * FROM premiacoes WHERE id = 2;');

		$totalJogadasMinuto = DB::select("SELECT COUNT(*) AS totalJogadasMinuto FROM giros_spin_compras WHERE usado = 1 AND DAYOFMONTH(updated_at) = ".date('j')." AND MINUTE(updated_at) = MINUTE('".date('Y-m-d H:i:s')."');");
		
		return \Response::json([$spinsDisponibilizados, $spinsRealizados, $totalParticipantes, $totalCuponsResgatados, $pontos, $totalJogadasMinuto]);
	}

	public function carregaCalendario(){ //Grafico de linhas de Premios Pagos por Dia no Mes Vigente
		//quantidade de spins disponibilizados
		/*
		$valor_pago = 0;
		$premios_mes_atual = array();
		$contador = 1;
		//Repetindo até o ultimo dia do mes atual:
		for ($i=0; $i <= (cal_days_in_month(CAL_GREGORIAN, date('n'), date('Y')) - 1); $i++) { 
			//pegando a contagem de todos os cupons gerados no dia da repeticao:
			$dia_sql = DB::select('SELECT SUM(valor_cupom) AS valor_pago FROM cupons_pontos WHERE MONTH(updated_at) = '.date('n').' AND status_cupom = 1 AND DAYOFMONTH(updated_at) = '.$contador);
			
			if (!is_null($dia_sql[0]->valor_pago)) {
				$valor_pago = $dia_sql[0]->valor_pago;
			}
			$premios_mes_atual[$i] = [$contador, $valor_pago]; //concatenando com a variavel q acumula os valores
			$valor_pago = 0;
			$contador++;
		}

		return \Response::json($premios_mes_atual);
		*/

		// -- NOVEMBRO -- //
		$valor_pago = 0;
		$premios_novembro = array();
		for ($i=1; $i <= 30; $i++) { 
			//pegando a contagem de todos os cupons gerados no dia da repeticao:
			$dia_sql = DB::select('SELECT SUM(valor) AS valor_pago FROM cupom_compras WHERE MONTH(updated_at) = 11 AND DAYOFMONTH(updated_at) = '.$i.' AND status_cupom = 1'); 
			
			if (!is_null($dia_sql[0]->valor_pago)) {
				$valor_pago = $dia_sql[0]->valor_pago;
			}
			$premios_novembro[$i-1]=[$i,$valor_pago]; //concatenando com a variavel q acumula os valores
			$valor_pago = 0;
		}
		//removendo a ultima virgula:
//		$premios_novembro = substr($premios_novembro,0, strlen($premios_novembro)-1);
		//fechando os colchetes:
//		$premios_novembro.=']';
/*
		// -- DEZEMBRO -- //
		$valor_pago = 0;
		$premios_dezembro = '[';
		for ($i=1; $i <= 31; $i++) { 
			//pegando a contagem de todos os cupons gerados no dia da repeticao:
			$dia_sql = DB::select('SELECT SUM(valor) AS valor_pago FROM cupom WHERE MONTH(updated_at) = 12 AND DAYOFMONTH(updated_at) = '.$i.' AND status_cupom = 1'); 
			
			if (!is_null($dia_sql[0]->valor_pago)) {
				$valor_pago = $dia_sql[0]->valor_pago;
			}
			$premios_dezembro.='['.$i.','.$valor_pago.'],'; //concatenando com a variavel q acumula os valores
			$valor_pago = 0;
		}
		//removendo a ultima virgula:
		$premios_dezembro = substr($premios_dezembro,0, strlen($premios_dezembro)-1);
		//fechando os colchetes:
		$premios_dezembro.=']';

		// -- JANEIRO -- //
		$valor_pago = 0;
		$premios_janeiro = '[';
		for ($i=1; $i <= 31; $i++) { 
			//pegando a contagem de todos os cupons gerados no dia da repeticao:
			$dia_sql = DB::select('SELECT SUM(valor) AS valor_pago FROM cupom WHERE MONTH(updated_at) = 1 AND DAYOFMONTH(updated_at) = '.$i.' AND status_cupom = 1'); 
			
			if (!is_null($dia_sql[0]->valor_pago)) {
				$valor_pago = $dia_sql[0]->valor_pago;
			}
			$premios_janeiro.='['.$i.','.$valor_pago.'],'; //concatenando com a variavel q acumula os valores
			$valor_pago = 0;
		}
		//removendo a ultima virgula:
		$premios_janeiro = substr($premios_janeiro,0, strlen($premios_janeiro)-1);
		//fechando os colchetes:
		$premios_janeiro.=']';

		// -- FEVEREIRO -- //
		$valor_pago = 0;
		$premios_fevereiro = '[';
		for ($i=1; $i <= 28; $i++) { 
			//pegando a contagem de todos os cupons gerados no dia da repeticao:
			$dia_sql = DB::select('SELECT SUM(valor) AS valor_pago FROM cupom WHERE MONTH(updated_at) = 2 AND DAYOFMONTH(updated_at) = '.$i.' AND status_cupom = 1'); 
			
			if (!is_null($dia_sql[0]->valor_pago)) {
				$valor_pago = $dia_sql[0]->valor_pago;
			}
			$premios_fevereiro.='['.$i.','.$valor_pago.'],'; //concatenando com a variavel q acumula os valores
			$valor_pago = 0;
		}
		//removendo a ultima virgula:
		$premios_fevereiro = substr($premios_fevereiro,0, strlen($premios_fevereiro)-1);
		//fechando os colchetes:
		$premios_fevereiro.=']';

		// -- MARÇO -- //
		$valor_pago = 0;
		$premios_marco = '[';
		for ($i=1; $i <= 31; $i++) { 
			//pegando a contagem de todos os cupons gerados no dia da repeticao:
			$dia_sql = DB::select('SELECT SUM(valor) AS valor_pago FROM cupom WHERE MONTH(updated_at) = 3 AND DAYOFMONTH(updated_at) = '.$i.' AND status_cupom = 1'); 
			
			if (!is_null($dia_sql[0]->valor_pago)) {
				$valor_pago = $dia_sql[0]->valor_pago;
			}
			$premios_marco.='['.$i.','.$valor_pago.'],'; //concatenando com a variavel q acumula os valores
			$valor_pago = 0;
		}
		//removendo a ultima virgula:
		$premios_marco = substr($premios_marco,0, strlen($premios_marco)-1);
		//fechando os colchetes:
		$premios_marco.=']';

		// -- ABRIL -- //
		$valor_pago = 0;
		$premios_abril = '[';
		for ($i=1; $i <= 30; $i++) { 
			//pegando a contagem de todos os cupons gerados no dia da repeticao:
			$dia_sql = DB::select('SELECT SUM(valor) AS valor_pago FROM cupom WHERE MONTH(updated_at) = 4 AND DAYOFMONTH(updated_at) = '.$i.' AND status_cupom = 1'); 
			
			if (!is_null($dia_sql[0]->valor_pago)) {
				$valor_pago = $dia_sql[0]->valor_pago;
			}
			$premios_abril.='['.$i.','.$valor_pago.'],'; //concatenando com a variavel q acumula os valores
			$valor_pago = 0;
		}
		//removendo a ultima virgula:
		$premios_abril = substr($premios_abril,0, strlen($premios_abril)-1);
		//fechando os colchetes:
		$premios_abril.=']';

		// -- MAIO -- //
		$valor_pago = 0;
		$premios_maio = '[';
		for ($i=1; $i <= 31; $i++) { 
			//pegando a contagem de todos os cupons gerados no dia da repeticao:
			$dia_sql = DB::select('SELECT SUM(valor) AS valor_pago FROM cupom WHERE MONTH(updated_at) = 5 AND DAYOFMONTH(updated_at) = '.$i.' AND status_cupom = 1'); 
			
			if (!is_null($dia_sql[0]->valor_pago)) {
				$valor_pago = $dia_sql[0]->valor_pago;
			}
			$premios_maio.='['.$i.','.$valor_pago.'],'; //concatenando com a variavel q acumula os valores
			$valor_pago = 0;
		}
		//removendo a ultima virgula:
		$premios_maio = substr($premios_maio,0, strlen($premios_maio)-1);
		//fechando os colchetes:
		$premios_maio.=']';
*/
		return \Response::json([$premios_novembro]);
	}
	/*
	public function carregaGraficoBarras() //Grafico de Barras com a Qtde de Spins liverados por NF
	{
		// -- SOMANDO A QUANTIDADE TOTAL DE NOTAS FISCAIS CADASTRADAS COM 1, 2, 3 ... 15 SPINS-- //
		$totalSpin1 = DB::select('SELECT COUNT(*) AS totalSpin1 FROM spin WHERE qtde_spins = 1');
		$totalSpin2 = DB::select('SELECT COUNT(*) AS totalSpin2 FROM spin WHERE qtde_spins = 2');
		$totalSpin3 = DB::select('SELECT COUNT(*) AS totalSpin3 FROM spin WHERE qtde_spins = 3');
		$totalSpin4 = DB::select('SELECT COUNT(*) AS totalSpin4 FROM spin WHERE qtde_spins = 4');
		$totalSpin5 = DB::select('SELECT COUNT(*) AS totalSpin5 FROM spin WHERE qtde_spins = 5');
		$totalSpin6 = DB::select('SELECT COUNT(*) AS totalSpin6 FROM spin WHERE qtde_spins = 6');
		$totalSpin7 = DB::select('SELECT COUNT(*) AS totalSpin7 FROM spin WHERE qtde_spins = 7');
		$totalSpin8 = DB::select('SELECT COUNT(*) AS totalSpin8 FROM spin WHERE qtde_spins = 8');
		$totalSpin9 = DB::select('SELECT COUNT(*) AS totalSpin9 FROM spin WHERE qtde_spins = 9');
		$totalSpin10 = DB::select('SELECT COUNT(*) AS totalSpin10 FROM spin WHERE qtde_spins = 10');
		$totalSpin11 = DB::select('SELECT COUNT(*) AS totalSpin11 FROM spin WHERE qtde_spins = 11');
		$totalSpin12 = DB::select('SELECT COUNT(*) AS totalSpin12 FROM spin WHERE qtde_spins = 12');
		$totalSpin13 = DB::select('SELECT COUNT(*) AS totalSpin13 FROM spin WHERE qtde_spins = 13');
		$totalSpin14 = DB::select('SELECT COUNT(*) AS totalSpin14 FROM spin WHERE qtde_spins = 14');
		$totalSpin15 = DB::select('SELECT COUNT(*) AS totalSpin15 FROM spin WHERE qtde_spins >= 15');
		return \Response::json([$totalSpin1, $totalSpin2, $totalSpin3, $totalSpin4, $totalSpin5, $totalSpin6, $totalSpin7, $totalSpin8, $totalSpin9, $totalSpin10, $totalSpin11, $totalSpin12, $totalSpin13, $totalSpin14, $totalSpin15]);
	}
	*/
	public function carregaSexos() //Grafico de Pizza com Total de participantes de cada sexo
	{
		//Pegando a quantidade de participantes de ambos os sexos:
		$homens = DB::select('SELECT COUNT(*) AS homens FROM participantes WHERE sexo = 0');
		$mulheres = DB::select('SELECT COUNT(*) AS mulheres FROM participantes WHERE sexo = 1');
		$qtde_favoritos = DB::select('SELECT COUNT(*) AS qtde_favoritos FROM publicacoes_favoritos');

		return \Response::json([$homens, $mulheres, $qtde_favoritos]);
	}

	public function carregaGraficoSpins() //Grafico de Pizza com Total de participantes de cada sexo
	{
		//Pegando a quantidade de participantes de ambos os sexos:
		$pdv = DB::select('SELECT SUM(qtde_spins) AS pdv FROM compras_clientes WHERE cartao_nagumo = 0;'); //0 - PDV
		$cartaoNagumo = DB::select('SELECT SUM(qtde_spins) AS cartaoNagumo FROM compras_clientes WHERE cartao_nagumo = 1'); //1 - Cartao Nagumo

		return \Response::json([$pdv, $cartaoNagumo]);
	}

	public function carregaTop10Promocoes() //Top 10 promocoes mais aderidas
	{
		$top10 = DB::select('SELECT b.id, b.titulo, COUNT(*) AS total FROM ofertas_participantes a INNER JOIN ofertas b on b.excluido = 0 AND b.dataFinal >= DATE_ADD(now(), INTERVAL -1 DAY) AND b.dataInicial <= DATE_ADD(now(), INTERVAL 0 DAY) AND a.id_oferta = b.id AND a.status_oferta = 1 GROUP BY b.titulo, b.id ORDER BY total DESC LIMIT 10;'); //1 - PDV
		
		return \Response::json($top10);
	}

	public function carregaTabelaCupons() //Tabela de cupons e Contador de Spins e Premiações
	{
		//pegando os cupons resgatados de R$10
		$cupons1 = DB::select('SELECT COUNT(*) AS cupons_resgatados1 FROM cupom_compras WHERE valor = 10.00 AND status_cupom =1');
		//pegando os cupons resgatados de R$50
		$cupons2 = DB::select('SELECT COUNT(*) AS cupons_resgatados2 FROM cupom_compras WHERE valor = 50.00 AND status_cupom =1');
		//pegando os cupons resgatados de R$100
		$cupons3 = DB::select('SELECT COUNT(*) AS cupons_resgatados3 FROM cupom_compras WHERE valor = 100.00 AND status_cupom =1');
		//pegando os cupons resgatados de R$200
		$cupons5 = DB::select('SELECT COUNT(*) AS cupons_resgatados5 FROM cupom_compras WHERE valor = 200.00 AND status_cupom =1');
		//pegando os cupons resgatados de R$500
		$cupons10 = DB::select('SELECT COUNT(*) AS cupons_resgatados10 FROM cupom_compras WHERE valor = 500.00 AND status_cupom =1');

		//pegando os cupons a resgatar  de R$10
		$cuponsResg1 = DB::select('SELECT COUNT(*) AS cupons_resgatar1 FROM cupom_compras WHERE valor = 10.00 AND status_cupom =0');
		//pegando os cupons a resgatar de R$50
		$cuponsResg2 = DB::select('SELECT COUNT(*) AS cupons_resgatar2 FROM cupom_compras WHERE valor = 50.00 AND status_cupom =0');
		//pegando os cupons a resgatar de R$100
		$cuponsResg3 = DB::select('SELECT COUNT(*) AS cupons_resgatar3 FROM cupom_compras WHERE valor = 100.00 AND status_cupom =0');
		//pegando os cupons a resgatar de R$200
		$cuponsResg5 = DB::select('SELECT COUNT(*) AS cupons_resgatar5 FROM cupom_compras WHERE valor = 200.00 AND status_cupom =0');
		//pegando os cupons a resgatar de R$500
		$cuponsResg10 = DB::select('SELECT COUNT(*) AS cupons_resgatar10 FROM cupom_compras WHERE valor = 500.00 AND status_cupom =0');

		return \Response::json([$cupons1, $cupons2, $cupons3, $cupons5, $cupons10, $cuponsResg1, $cuponsResg2, $cuponsResg3, $cuponsResg5, $cuponsResg10]);
	}

	public function totalParticipantes() //Total de Participantes no app, por dia/semana e mes
	{
		// -- QUANTIDADE DE PARTICIPANTES CADASTRADOS VIA APP (DADOS NÃO PRECISOS)-- //
		$totalParticipantesApp = DB::select('SELECT COUNT(*) AS totalParticipantesApp FROM participantes WHERE nome_razao_social != "Não preenchido" OR nome_razao_social != null');

		// -- QUANTIDADE DE PARTICIPANTES CADASTRADOS NO DIA/SEMANA/MES-- //
		$participantesDia = DB::select("SELECT COUNT(*) AS participantesDia FROM participantes WHERE MONTH(created_at) = MONTH(now()) AND DAYOFMONTH(created_at) = ".date('j'));
		$participantesSemana = DB::select("SELECT COUNT(*) AS participantesSemana FROM participantes WHERE WEEK (created_at ,0) = WEEK(NOW())");
		$participantesMes = DB::select("SELECT COUNT(*) AS participantesMes FROM participantes WHERE MONTH(created_at) = MONTH(now())");

		// -- QUANTIDADE DE ADESOES DAS OFERTAS POR DIA/SEMANA/MES -- //
		$ofertasDia = DB::select("SELECT COUNT(b.id) AS ofertasDia FROM ofertas b INNER JOIN ofertas_participantes a on b.id = a.id_oferta AND b.excluido = 0 AND b.dataFinal >= DATE_ADD(now(), INTERVAL -1 DAY) AND b.dataInicial <= DATE_ADD(now(), INTERVAL 0 DAY) AND MONTH(a.created_at) = MONTH(now()) AND DAYOFMONTH(a.created_at) = ".date('j'));
		$ofertasSemana = DB::select("SELECT COUNT(b.id) AS ofertasSemana FROM ofertas b INNER JOIN ofertas_participantes a on b.id = a.id_oferta AND b.excluido = 0 AND b.dataFinal >= DATE_ADD(now(), INTERVAL -1 DAY) AND b.dataInicial <= DATE_ADD(now(), INTERVAL 0 DAY) AND WEEK (a.created_at ,0) = WEEK(NOW());");
		$ofertasMes = DB::select("SELECT COUNT(b.id) AS ofertasMes FROM ofertas b INNER JOIN ofertas_participantes a on b.id = a.id_oferta AND b.excluido = 0 AND b.dataFinal >= DATE_ADD(now(), INTERVAL -1 DAY) AND b.dataInicial <= DATE_ADD(now(), INTERVAL 0 DAY) AND MONTH(a.created_at) = MONTH(now());");

		// -- FATURAMENTO POR DIA/SEMANA/MES -- //
		$faturamentoDia = DB::select("SELECT COALESCE(SUM(valor_total),0) AS faturamentoDia FROM compras_clientes WHERE MONTH(created_at) = MONTH(now()) AND DAYOFMONTH(created_at) = ".date('j'));
		$faturamentoSemana = DB::select("SELECT COALESCE(SUM(valor_total),0) AS faturamentoSemana FROM compras_clientes WHERE WEEK (created_at ,0) = WEEK(NOW());");
		$faturamentoMes = DB::select("SELECT COALESCE(SUM(valor_total),0) AS faturamentoMes FROM compras_clientes WHERE MONTH(created_at) = MONTH(now());");
		
		// -- TICKET MEDIO POR DIA/SEMANA/MES -- //
		$ticketDia = DB::select("SELECT COALESCE(FORMAT((SUM(valor_total) / (SELECT COUNT(*) FROM compras_clientes WHERE MONTH(created_at) = MONTH(now()) AND DAYOFMONTH(created_at) = ".date('j').")), 2),0) AS ticketDia FROM compras_clientes WHERE MONTH(created_at) = MONTH(now()) AND DAYOFMONTH(created_at) = ".date('j'));
		$ticketSemana = DB::select("SELECT COALESCE(FORMAT((SUM(valor_total) / (SELECT COUNT(*) FROM compras_clientes WHERE WEEK (created_at ,0) = WEEK(NOW()))), 2),0) AS ticketSemana FROM compras_clientes WHERE WEEK (created_at ,0) = WEEK(NOW());");
		$ticketMes = DB::select("SELECT COALESCE(FORMAT((SUM(valor_total) / (SELECT COUNT(*) FROM compras_clientes WHERE MONTH (created_at) = MONTH(NOW()))), 2),0) AS ticketMes FROM compras_clientes WHERE MONTH (created_at) = MONTH(NOW());");

		// -- TOTAL DE COMPRAS POR DIA/SEMANA/MES -- //
		$comprasDia = DB::select("SELECT COUNT(*) AS comprasDia FROM compras_clientes WHERE MONTH(created_at) = MONTH(now()) AND DAYOFMONTH(created_at) = ".date('j'));
		$comprasSemana = DB::select("SELECT COUNT(*) AS comprasSemana FROM compras_clientes WHERE WEEK (created_at ,0) = WEEK(NOW());");
		$comprasMes = DB::select("SELECT COUNT(*) AS comprasMes FROM compras_clientes WHERE MONTH(created_at) = MONTH(now());");

		
		return \Response::json([$totalParticipantesApp, $participantesDia, $participantesSemana, $participantesMes, $ofertasDia, $ofertasSemana, $ofertasMes, $faturamentoDia, $faturamentoSemana, $faturamentoMes, $ticketDia, $ticketSemana, $ticketMes, $comprasDia, $comprasSemana, $comprasMes]);
		
	}

	public function acoesRecentesUsuarios() //Pega AS 4 ultimas acoes dos usuarios do Site (Todos)
	{
		$acoesRecentes = DB::table('acoes_recentes')->join('usuarios', 'acoes_recentes.id_usuario', '=', 'usuarios.id')->select('acoes_recentes.*', 'usuarios.nome', 'usuarios.foto')->orderBy('acoes_recentes.created_at', 'desc')->take(4)->get();
		//DB::select('SELECT a.*, b.foto, b.nome FROM acoes_recentes a, usuarios b WHERE a.id_usuario = b.id ORDER BY created_at DESC LIMIT 4');
		return \Response::json($acoesRecentes);
	}

	// -- FIM CARREGAMENTOS INDEX AJAX -- //

	public function index(Request $request) //Página inicial
	{
		// -- LISTAGEM DE AFAZERES -- //
		$listagemAfazeres = DB::table('afazeres')->where('id_usuario', \Request::session()->get('id_usuario'))->get();

		// -- NOTAS -- //
		$notas = Usuarios::select('notas')->where('id', \Request::session()->get('id_usuario'))->get();

		return view('index1',compact("listagemAfazeres", "notas"));
	}
		
}