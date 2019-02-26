<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; //chamando a classe extendida
use Illuminate\Support\Facades\DB; //classe de comunicacao com o BD
use App\WP_Cursos;
use Carbon\Carbon;
use App\WP_Posts;
use App\WP_Commentmeta;




class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $adesaoCursosDia = WP_Cursos::select(DB::raw('COUNT(*) AS adesaoCursosDia'))->where('post_status', '=', 'publish')->whereYear('post_date', date('Y'))->whereMonth('post_date', date('n'))->whereDay('post_date', date('j'))->get();
        $adesaoCursosSemana = DB::select("SELECT COUNT(*) AS adesaoCursosSemana FROM wp_posts WHERE YEAR(post_date) = ".date('Y')." AND WEEK (post_date ,0) = WEEK(NOW())");
        $adesaoCursosMes = WP_Cursos::select(DB::raw('COUNT(*) AS adesaoCursosMes'))->whereYear('post_date', date('Y'))->whereMonth('post_date', date('n'))->get();

        return \Response::json([$adesaoCursosDia, $adesaoCursosSemana, $adesaoCursosMes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function top(Request $request)
    {
        	
		
        $nomeCursos = DB::select('SELECT COUNT(p.post_title) AS total, p.ID, p.post_title AS curso, COUNT(c.user_id) alunos FROM wp_posts AS p INNER JOIN wp_comments AS c ON c.comment_post_id = p.ID INNER JOIN wp_commentmeta AS cm ON cm.comment_id = c.comment_ID AND cm.meta_key = "start" AND p.post_type = "course" GROUP BY p.ID, p.post_title  ORDER BY alunos DESC');
        
        return \Response::json($nomeCursos);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function volumeAcessos()
     {
        $cursos = 0;
		$alunos = array();
		for ($i=1; $i <= 30; $i++) { 
			            
            $dia_sql = WP_Commentmeta::whereDay('meta_value', $i)->where('meta_key', 'start')->count('meta_key');

			if (!is_null($dia_sql)) {
				$cursos = $dia_sql;
			}
			$alunos[$i-1] = [$i,$cursos];
			$cursos = 0;
        }
        
        return \Response::json($alunos);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
