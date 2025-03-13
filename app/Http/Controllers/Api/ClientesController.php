<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientesPostRequest;
use App\Models\Clientes;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClientesController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"Clientes"},
     *   path="/api/path",
     *   summary="Clientes index",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/ClientesResource")
     *       ),
     *       @OA\Property(property="links", ref="#/components/schemas/PageLinks"),
     *       @OA\Property(property="meta", ref="#/components/schemas/PageMeta")
     *     )
     *   )
     * )
     */
    public function index() {
        return response()->json(Clientes::all());    
    }

    /**
     * @OA\Get(
     *   tags={"Clientes"},
     *   path="/api/path/{id}",
     *   summary="Clientes show",
     *   @OA\Parameter(ref="#/components/parameters/id"),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/ClientesResource")
     *   ),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($empresa, $codigo)
    {
        $cliente = Clientes::where('empresa', $empresa)->where('codigo', $codigo)->first();

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return response()->json($cliente);
    }

    /**
     * @OA\Post(
     *   tags={"Clientes"},
     *   path="/api/path/{id}",
     *   summary="Clientes store",
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
     *     @OA\JsonContent(ref="#/components/schemas/ClientesResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function store(ClientesPostRequest $requisicao)
    {
        try {
            $cliente = Clientes::create($requisicao->validated());

            return response()->json([
                'message' => 'Cliente criado com sucesso!',
                'cliente' => $cliente
            ], 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Erro ao salvar cliente', 'error' => $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro inesperado', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Put(
     *   tags={"Clientes"},
     *   path="/api/path/{id}",
     *   summary="Clientes update",
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
     *     @OA\JsonContent(ref="#/components/schemas/ClientesResource")
     *   ),
     *   @OA\Response(response=404, description="Not Found"),
     *   @OA\Response(response=422, description="Unprocessable Entity")
     * )
     */
    public function update(Request $request, $empresa, $codigo)
    {
        $cliente = Clientes::where('empresa', $empresa)->where('codigo', $codigo)->first();

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $cliente->update($request->all());

        return response()->json(['message' => 'Cliente atualizado com sucesso!', 'cliente' => $cliente]);
    }

    /**
     * @OA\Delete(
     *   tags={"Clientes"},
     *   path="/api/path/{id}",
     *   summary="Clientes destroy",
     *   @OA\Parameter(ref="#/components/parameters/id"),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/Clientes")
     *   ),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function destroy($empresa, $codigo)
    {
        $cliente = Clientes::where('empresa', $empresa)->where('codigo', $codigo)->first();

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $cliente->delete();

        return response()->json(['message' => 'Cliente deletado com sucesso!']);
    }
}
