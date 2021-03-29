<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Storage;

class EmpresasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (Empresas::all()->count() == 0) {

            return $this->novaEmpresa();
        } else {

            return $this->editarEmpresa();
        }
    }

    private function novaEmpresa()
    {

        return view('dashboard.empresa.frm-nova-empresa');
    }

    public function salvarEmpresa(Request $request)
    {
        $dados_empresa = $request->all();

        $dados_empresa['cnpj']      = $this->somenteNumeros($dados_empresa['cnpj']);
        $dados_empresa['cep']       = $this->somenteNumeros($dados_empresa['cep']);
        $dados_empresa['telefone1'] = $this->somenteNumeros($dados_empresa['telefone1']);
        $dados_empresa['telefone2'] = $this->somenteNumeros($dados_empresa['telefone2']);
        $dados_empresa['whatsapp1'] = $this->somenteNumeros($dados_empresa['whatsapp1']);
        $dados_empresa['whatsapp2'] = $this->somenteNumeros($dados_empresa['whatsapp2']);

        try {

            if (isset($dados_empresa["logo"])) {
                $logo = str_replace("public/", "", $request->file("logo")->store("public/empresa"));
                $dados_empresa["logo"] = $logo;
            }

            Empresas::Create($dados_empresa);
            Log::info("nova empresa criada: " . $dados_empresa['nome_fantasia'] . " Usuario: " . Auth::user()->name);
            session(['status_cadastro' => true]);
            return redirect('/empresa');
            //
        } //
        catch (Exception $e) {

            Log::error("erro ao criar nova empresa: " . $e->getMessage());
            return redirect('/empresa')->with(["status_cadastro" => "erro ao criar nova empresa: " . $e->getMessage()]);
        }
    }

    private function editarEmpresa()
    {
        if (session()->has('status_cadastro')) {

            $status_cadastro = 'Empresa cadastrada com sucesso';

            session()->forget('status_cadastro');
        } //
        else {
            $status_cadastro = null;
        }

        $dados = Empresas::all();

        $empresa = $dados[0];

        return view('dashboard.empresa.frm-editar-empresa', compact('status_cadastro', 'empresa'));
    }

    public function salvarEdicaoEmpresa(Request $request)
    {
        try {

            $dados_empresa = $request->all();
            $dados_empresa['cnpj']      = $this->somenteNumeros($dados_empresa['cnpj']);
            $dados_empresa['cep']       = $this->somenteNumeros($dados_empresa['cep']);
            $dados_empresa['telefone1'] = $this->somenteNumeros($dados_empresa['telefone1']);
            $dados_empresa['telefone2'] = $this->somenteNumeros($dados_empresa['telefone2']);
            $dados_empresa['whatsapp1'] = $this->somenteNumeros($dados_empresa['whatsapp1']);
            $dados_empresa['whatsapp2'] = $this->somenteNumeros($dados_empresa['whatsapp2']);
            $dados_empresa['segunda']   = isset($dados_empresa['segunda']) ? "1" : "0";
            $dados_empresa['terca']     = isset($dados_empresa['terca']) ? "1" : "0";
            $dados_empresa['quarta']    = isset($dados_empresa['quarta']) ? "1" : "0";
            $dados_empresa['quinta']    = isset($dados_empresa['quinta']) ? "1" : "0";
            $dados_empresa['sexta']     = isset($dados_empresa['sexta']) ? "1" : "0";
            $dados_empresa['sabado']    = isset($dados_empresa['sabado']) ? "1" : "0";
            $dados_empresa['domingo']   = isset($dados_empresa['domingo']) ? "1" : "0";

            // dd($dados_empresa);

            if (isset($dados_empresa['logo'])) {
                Storage::delete('public/' . $dados_empresa['logo_old']);
                $dados_empresa['logo'] = str_replace("public/", "", $request->file("logo")->store("public/empresa"));
            }
            unset($dados_empresa['logo_old']);
            unset($dados_empresa['_token']);
            DB::table('empresas')->where('id', $dados_empresa['id'])->update($dados_empresa);
            Log::info('Empresa id:' . $dados_empresa['id'] . ' editada pelo usuario:' . Auth::user()->name);
            return redirect('/empresa')->with(['status_edicao' => 'Editado com sucesso']);
        } //
        catch (Exception $e) {

            Log::error('Erro ao editar empresa:' . $e->getMessage());
            return redirect('/empresa')->with(['status_edicao' => 'Erro ao editar:' . $e->getMessage()]);
        }
    }

    private function somenteNumeros($var)
    {

        $var = str_replace('.', '', $var);
        $var = str_replace('/', '', $var);
        $var = str_replace('-', '', $var);
        $var = str_replace('(', '', $var);
        $var = str_replace(')', '', $var);
        return $var;
    }
}
