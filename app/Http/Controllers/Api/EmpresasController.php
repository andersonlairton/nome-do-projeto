<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresasDestroyRequest;
use App\Http\Requests\EmpresasRequest;
use App\Http\Requests\EmpresasUpdateRequest;
use App\Models\Empresas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EmpresasController extends Controller
{
    /**
     * metodo responsavel por listar todas as empresas 
     * @OA\Get(
     *   tags={"Empresas"},
     *   path="/api/path",
     *   summary="Empresas index",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/EmpresasResource")
     *       ),
     *       @OA\Property(property="links", ref="#/components/schemas/PageLinks"),
     *       @OA\Property(property="meta", ref="#/components/schemas/PageMeta")
     *     )
     *   )
     * )
     */
    public function index()
    {
        $empresas = Empresas::all();

        return response()->json($empresas);
    }

    /**
     * metodo responsavel por cadastrar novas empresas
     * @OA\Post(
     *   tags={"Empresas"},
     *   path="/api/path/{id}",
     *   summary="Empresas store",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"xxx"},
     *       @OA\Property(property="xxx", type="string")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/EmpresasResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function store(EmpresasRequest $requisicao)
    {

        try {
            // print_r($requisicao);die;
            $dados = $requisicao->all();

            //  $validator = Validator::make($requisicao->all(), [
            //     'codigo' => 'required|numeric|unique:empresas,codigo',
            //     'empresa' => 'required',
            // ]);



            dd($requisicao->all());
            $empresas = Empresas::create($dados);
            return response()->json($empresas, 201);
        } catch (ValidationException $e) {
            dd('deu ruim');
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * metodo responsavel por realizar atualizações no cadastro da empresa
     * @OA\Put(
     *   tags={"Empresas"},
     *   path="/api/path/{id}",
     *   summary="Empresas update",
     *   @OA\Parameter(ref="#/components/parameters/id"),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"xxxx"},
     *       @OA\Property(property="xxxx", type="string")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/EmpresasResource")
     *   ),
     *   @OA\Response(response=404, description="Not Found"),
     *   @OA\Response(response=422, description="Unprocessable Entity")
     * )
     */
    public function update(EmpresasUpdateRequest $requisicao, $codigo)
    {

        try {

            $empresa = Empresas::where(['codigo' => $codigo])->firstOrFail();

            if (empty($empresa)) {
                throw new Exception("Empresa não encontrada");
            }

            $empresa->update($requisicao->validated());

            return response()->json(['message' => "Empresa Atualizada com sucesso", 'empresa' => $empresa], 201);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }

    /**
     * metodo responsavel por apagar uma empresa
     * @OA\Delete(
     *   tags={"Empresas"},
     *   path="/api/path/{id}",
     *   summary="Empresas destroy",
     *   @OA\Parameter(ref="#/components/parameters/id"),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/Empresas")
     *   ),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function destroy($codigo)
    {
        try {
            $empresa = Empresas::where('codigo', $codigo)->firstOrFail();

            // Deleta a empresa
            $empresa->delete();

            // Retorna resposta de sucesso
            return response()->json(['message' => 'Empresa deletada com sucesso!'], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }

    /**
     * metodo responsavel por retornar dados de uma empresa especifica
     * @OA\Get(
     *   tags={"Empresas"},
     *   path="/api/path/{id}",
     *   summary="Empresas show",
     *  
     *   @OA\Parameter(ref="#/components/parameters/id"),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/EmpresasResource")
     *   ),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($codigo){
        try {
            $empresa = Empresas::where('codigo', $codigo)->firstOrFail();
    
            return response()->json($empresa, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Empresa não encontrada: ' . $e->getMessage()], 404);
        }
    }
}
