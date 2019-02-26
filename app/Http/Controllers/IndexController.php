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
use App\Participantes;
use App\Ofertas_Participantes;
use App\Cupom_Compras;
use App\Compras_Clientes;

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
		$spinsDisponibilizados = Compras_Clientes::select(DB::raw('SUM(qtde_spins) AS qtde_spins'))->get();
		//quantidade de spins realizados
		$spinsRealizados = DB::select('SELECT (SUM(qtde_spins) - SUM(saldo_spins)) AS spins_realizados FROM compras_clientes');
		//quantidade de participantes
		$totalParticipantes = Participantes::select(DB::raw('COUNT(*) AS total_participantes'))->get();
		//quantidade total de cupons resgatados
		$totalCuponsResgatados = Cupom_Compras::select(DB::raw('COUNT(*) AS total_cupons_resgatados'))->where('status_cupom', 1)->get();
		//Andamento da distribuição da pontuação:
		$pontos = DB::select('SELECT * FROM premiacoes WHERE id = 2;');

		$totalJogadasMinuto = DB::select("SELECT COUNT(*) AS totalJogadasMinuto FROM giros_spin_compras WHERE usado = 1 AND MONTH(updated_at) = MONTH(now()) AND DAYOFMONTH(updated_at) = ".date('j')." AND MINUTE(updated_at) = MINUTE(now());");
		
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
			$dia_sql = Cupom_Compras::whereYear('updated_at', 2018)->whereMonth('updated_at', 11)->whereDay('updated_at', $i)->where('status_cupom', 1)->sum('valor');

			if (!is_null($dia_sql)) {
				$valor_pago = $dia_sql;
			}
			$premios_novembro[$i-1] = [$i,$valor_pago]; //concatenando com a variavel q acumula os valores
			$valor_pago = 0;
		}
		//removendo a ultima virgula:
//		$premios_novembro = substr($premios_novembro,0, strlen($premios_novembro)-1);
		//fechando os colchetes:
//		$premios_novembro.=']';

		// -- DEZEMBRO -- //
		$valor_pago = 0;
		$premios_dezembro = array();
		for ($i=1; $i <= 31; $i++) { 
			//pegando a contagem de todos os cupons gerados no dia da repeticao:
			$dia_sql = Cupom_Compras::whereYear('updated_at', 2018)->whereMonth('updated_at', 12)->whereDay('updated_at', $i)->where('status_cupom', 1)->sum('valor');
			
			if (!is_null($dia_sql)) {
				$valor_pago = $dia_sql;
			}
			$premios_dezembro[$i-1] = [$i,$valor_pago]; //concatenando com a variavel q acumula os valores
			$valor_pago = 0;
		}

		
		// -- JANEIRO -- //
		$valor_pago = 0;
		$premios_janeiro = array();
		for ($i=1; $i <= 31; $i++) { 
			//pegando a contagem de todos os cupons gerados no dia da repeticao:
			$dia_sql = Cupom_Compras::whereYear('updated_at', 2019)->whereMonth('updated_at', 1)->whereDay('updated_at', $i)->where('status_cupom', 1)->sum('valor');
			
			if (!is_null($dia_sql)) {
				$valor_pago = $dia_sql;
			}
			$premios_janeiro[$i-1] = [$i,$valor_pago]; //concatenando com a variavel q acumula os valores
			$valor_pago = 0;
		}
		/*
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
		return \Response::json([$premios_novembro, $premios_dezembro, $premios_janeiro]);
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
		$homens = Participantes::select(DB::raw('COUNT(*) AS homens'))->where('sexo', 0)->get();
		$mulheres = Participantes::select(DB::raw('COUNT(*) AS mulheres'))->where('sexo', 1)->get();
		$qtde_favoritos = DB::table('publicacoes_favoritos')->select(DB::raw('COUNT(*) AS qtde_favoritos'))->get();

		return \Response::json([$homens, $mulheres, $qtde_favoritos]);
	}

	public function carregaGraficoSpins() //Grafico de Pizza com Total de participantes de cada sexo
	{
		//Pegando a quantidade de participantes de ambos os sexos:
		$pdv = Compras_Clientes::select(DB::raw('SUM(qtde_spins) AS pdv'))->where('cartao_nagumo', 0)->get();
		$cartaoNagumo = Compras_Clientes::select(DB::raw('SUM(qtde_spins) AS cartaoNagumo'))->where('cartao_nagumo', 1)->get();

		return \Response::json([$pdv, $cartaoNagumo]);
	}

	public function carregaTop10Promocoes() //Top 10 promocoes mais aderidas
	{
		$top10 = Ofertas_Participantes::where('ofertas_participantes.status_oferta', 1)->join('ofertas','ofertas_participantes.id_oferta', '=', 'ofertas.id')->where('ofertas.excluido', 0)->whereDate('ofertas.dataFinal', '>=', date('Y-m-d'))->whereDate('ofertas.dataInicial', '<=', date('Y-m-d'))->select(DB::raw('COUNT(1) AS total'), 'ofertas.id', 'ofertas.titulo')->groupBy('ofertas.titulo', 'ofertas.id')->orderBy('total', 'desc')->take(10)->get();

		//DB::select('SELECT b.id, b.titulo, COUNT(*) AS total FROM ofertas_participantes a INNER JOIN ofertas b on b.excluido = 0 AND b.dataFinal >= DATE_ADD(now(), INTERVAL -1 DAY) AND b.dataInicial <= DATE_ADD(now(), INTERVAL 0 DAY) AND a.id_oferta = b.id AND a.status_oferta = 1 GROUP BY b.titulo, b.id ORDER BY total DESC LIMIT 10;'); //1 - PDV
		
		return \Response::json($top10);
	}

	public function carregaTabelaCupons() //Tabela de cupons e Contador de Spins e Premiações
	{
		$cupons1 = Cupom_Compras::select(DB::raw('COUNT(*) AS cupons_resgatados1'))->where('valor', 10.00)->where('status_cupom', 1)->get();
		$cupons2 = Cupom_Compras::select(DB::raw('COUNT(*) AS cupons_resgatados2'))->where('valor', 50.00)->where('status_cupom', 1)->get();
		$cupons3 = Cupom_Compras::select(DB::raw('COUNT(*) AS cupons_resgatados3'))->where('valor', 100.00)->where('status_cupom', 1)->get();
		$cupons5 = Cupom_Compras::select(DB::raw('COUNT(*) AS cupons_resgatados5'))->where('valor', 200.00)->where('status_cupom', 1)->get();
		$cupons10 = Cupom_Compras::select(DB::raw('COUNT(*) AS cupons_resgatados10'))->where('valor', 500.00)->where('status_cupom', 1)->get();

		$cuponsResg1 = Cupom_Compras::select(DB::raw('COUNT(*) AS cupons_resgatar1'))->where('valor', 10.00)->where('status_cupom', 0)->get();
		$cuponsResg2 = Cupom_Compras::select(DB::raw('COUNT(*) AS cupons_resgatar2'))->where('valor', 50.00)->where('status_cupom', 0)->get();
		$cuponsResg3 = Cupom_Compras::select(DB::raw('COUNT(*) AS cupons_resgatar3'))->where('valor', 100.00)->where('status_cupom', 0)->get();
		$cuponsResg5 = Cupom_Compras::select(DB::raw('COUNT(*) AS cupons_resgatar5'))->where('valor', 200.00)->where('status_cupom', 0)->get();
		$cuponsResg10 = Cupom_Compras::select(DB::raw('COUNT(*) AS cupons_resgatar10'))->where('valor', 500.00)->where('status_cupom', 0)->get();
		
		return \Response::json([$cupons1, $cupons2, $cupons3, $cupons5, $cupons10, $cuponsResg1, $cuponsResg2, $cuponsResg3, $cuponsResg5, $cuponsResg10]);
	}

	public function totalParticipantes() //Total de Participantes no app, por dia/semana e mes
	{
		// -- QUANTIDADE DE PARTICIPANTES CADASTRADOS VIA APP (DADOS NÃO PRECISOS)-- //
		$totalParticipantesApp = Participantes::select(DB::raw('COUNT(*) AS totalParticipantesApp'))->where('nome_razao_social', '!=', 'Não preenchido')->orWhereNull('nome_razao_social')->get();

		// -- QUANTIDADE DE PARTICIPANTES CADASTRADOS NO DIA/SEMANA/MES-- //
		$participantesDia = Participantes::select(DB::raw('COUNT(*) AS participantesDia'))->whereYear('created_at', date('Y'))->whereMonth('created_at', date('n'))->whereDay('created_at', date('j'))->get();
		$participantesSemana = DB::select("SELECT COUNT(*) AS participantesSemana FROM participantes WHERE YEAR(created_at) = ".date('Y')." AND WEEK (created_at ,0) = WEEK(NOW())");
		$participantesMes = Participantes::select(DB::raw('COUNT(*) AS participantesMes'))->whereYear('created_at', date('Y'))->whereMonth('created_at', date('n'))->get();

		// -- QUANTIDADE DE ADESOES DAS OFERTAS POR DIA/SEMANA/MES -- //
		$ofertasDia = DB::table('ofertas')->join('ofertas_participantes', 'ofertas.id', '=', 'ofertas_participantes.id_oferta')->select(DB::raw('COUNT(ofertas.id) AS ofertasDia'))->where('ofertas.excluido', 0)->whereYear('ofertas_participantes.created_at', date('Y'))->whereMonth('ofertas_participantes.created_at', date('n'))->whereDay('ofertas_participantes.created_at', date('j'))->whereDate('ofertas.dataFinal', '>=', date('Y-m-d'))->whereDate('ofertas.dataInicial', '<=', date('Y-m-d'))->get();

		//DB::select("SELECT COUNT(b.id) AS ofertasDia FROM ofertas b INNER JOIN ofertas_participantes a on b.id = a.id_oferta AND b.excluido = 0 AND MONTH(a.created_at) = MONTH(now()) AND DAYOFMONTH(a.created_at) = ".date('j')." AND  b.dataFinal >= DATE_ADD(now(), INTERVAL 0 DAY) AND b.dataInicial <= DATE_ADD(now(), INTERVAL 0 DAY) ");
		
		$ofertasSemana = DB::select("SELECT COUNT(b.id) AS ofertasSemana FROM ofertas b INNER JOIN ofertas_participantes a on b.id = a.id_oferta AND b.excluido = 0 AND b.dataFinal >= DATE_ADD(now(), INTERVAL -1 DAY) AND b.dataInicial <= DATE_ADD(now(), INTERVAL 0 DAY) AND WEEK (a.created_at ,0) = WEEK(NOW());");
		$ofertasMes = DB::table('ofertas')->join('ofertas_participantes', 'ofertas.id', '=', 'ofertas_participantes.id_oferta')->select(DB::raw('COUNT(ofertas.id) AS ofertasMes'))->where('ofertas.excluido', 0)->whereYear('ofertas_participantes.created_at', date('Y'))->whereMonth('ofertas_participantes.created_at', date('n'))->whereDate('ofertas.dataFinal', '>=', date('Y-m-d'))->whereDate('ofertas.dataInicial', '<=', date('Y-m-d'))->get();

		//DB::select("SELECT COUNT(b.id) AS ofertasMes FROM ofertas b INNER JOIN ofertas_participantes a on b.id = a.id_oferta AND b.excluido = 0 AND b.dataFinal >= DATE_ADD(now(), INTERVAL 0 DAY) AND b.dataInicial <= DATE_ADD(now(), INTERVAL 0 DAY) AND YEAR(a.created_at) = ".date('Y')." AND MONTH(a.created_at) = MONTH(now());");

		// -- FATURAMENTO POR DIA/SEMANA/MES -- //
		$faturamentoDia = Compras_Clientes::select(DB::raw('SUM(valor_total) AS faturamentoDia'))->whereYear('created_at', date('Y'))->whereMonth('created_at', date('n'))->whereDay('created_at', date('j'))->get();
		$faturamentoSemana = DB::select("SELECT COALESCE(SUM(valor_total),0) AS faturamentoSemana FROM compras_clientes WHERE YEAR(created_at) = ".date('Y')." AND WEEK (created_at ,0) = WEEK(NOW());");
		$faturamentoMes = Compras_Clientes::select(DB::raw('SUM(valor_total) AS faturamentoMes'))->whereYear('created_at', date('Y'))->whereMonth('created_at', date('n'))->get();
		
		// -- TICKET MEDIO POR DIA/SEMANA/MES -- //
		$ticketDia = DB::select("SELECT COALESCE(FORMAT((SUM(valor_total) / (SELECT COUNT(*) FROM compras_clientes WHERE YEAR(created_at) = ".date('Y')." AND MONTH(created_at) = MONTH(now()) AND DAYOFMONTH(created_at) = ".date('j').")), 2),0) AS ticketDia FROM compras_clientes WHERE YEAR(created_at) = ".date('Y')." AND MONTH(created_at) = MONTH(now()) AND DAYOFMONTH(created_at) = ".date('j'));
		$ticketSemana = DB::select("SELECT COALESCE(FORMAT((SUM(valor_total) / (SELECT COUNT(*) FROM compras_clientes WHERE YEAR(created_at) = ".date('Y')." AND WEEK (created_at ,0) = WEEK(NOW()))), 2),0) AS ticketSemana FROM compras_clientes WHERE YEAR(created_at) = ".date('Y')." AND WEEK (created_at ,0) = WEEK(NOW());");
		$ticketMes = DB::select("SELECT COALESCE(FORMAT((SUM(valor_total) / (SELECT COUNT(*) FROM compras_clientes WHERE YEAR(created_at) = ".date('Y')." AND MONTH (created_at) = MONTH(NOW()))), 2),0) AS ticketMes FROM compras_clientes WHERE YEAR(created_at) = ".date('Y')." AND MONTH (created_at) = MONTH(NOW());");

		// -- TOTAL DE COMPRAS POR DIA/SEMANA/MES -- //
		$comprasDia = Compras_Clientes::select(DB::raw('COUNT(*) AS comprasDia'))->whereYear('created_at', date('Y'))->whereMonth('created_at', date('n'))->whereDay('created_at', date('j'))->get();
		$comprasSemana = DB::select("SELECT COUNT(*) AS comprasSemana FROM compras_clientes WHERE YEAR(created_at) = ".date('Y')." AND WEEK (created_at ,0) = WEEK(NOW());");
		$comprasMes = Compras_Clientes::select(DB::raw('COUNT(*) AS comprasMes'))->whereYear('created_at', date('Y'))->whereMonth('created_at', date('n'))->get();

		
		return \Response::json([$totalParticipantesApp, $participantesDia, $participantesSemana, $participantesMes, $ofertasDia, $ofertasSemana, $ofertasMes, $faturamentoDia, $faturamentoSemana, $faturamentoMes, $ticketDia, $ticketSemana, $ticketMes, $comprasDia, $comprasSemana, $comprasMes]);
		
	}

	public function acoesRecentesUsuarios() //Pega AS 4 ultimas acoes dos usuarios do Site (Todos)
	{
		$acoesRecentes = DB::table('acoes_recentes')->join('usuarios', 'acoes_recentes.id_usuario', '=', 'usuarios.id')->select('acoes_recentes.*', 'usuarios.nome', 'usuarios.foto')->orderBy('acoes_recentes.created_at', 'desc')->take(4)->get();
		//DB::select('SELECT a.*, b.foto, b.nome FROM acoes_recentes a, usuarios b WHERE a.id_usuario = b.id ORDER BY created_at DESC LIMIT 4');
		return \Response::json($acoesRecentes);
	}

	// -- FIM CARREGAMENTOS INDEX AJAX -- //

	public function salvaNotas(UsuarioRequest $request){ //atualizando
		$usuario = Usuarios::find(\Request::session()->get('id_usuario')); //pegando o produto a atualizar
		$usuario->notas = $request->notas;

		$update = $usuario->save(); //atualizando
		//redirecionando de acordo com o resultado do update
		return redirect('/'); 
	}

	public function index(Request $request) //Página inicial
	{
		// -- LISTAGEM DE AFAZERES -- //
		$listagemAfazeres = DB::table('afazeres')->where('id_usuario', \Request::session()->get('id_usuario'))->get();
		
		// -- NOTAS -- //
		$notas = Usuarios::select('notas')->where('id', \Request::session()->get('id_usuario'))->get();

		return view('index1',compact("listagemAfazeres", "notas"));
	}
		
}