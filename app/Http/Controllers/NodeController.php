<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;
use App\Services\NodeService;
use App\Validations\UpdateNodeValidation;
use App\Validations\CreateNodeValidation;

class NodeController extends Controller
{
    /**
     * Class properties
     * 
     * @property 
     */
    private $nodeService;
    private $updateNodeValidation;
    private $createNodeValidation;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        NodeService $nodeService,
        UpdateNodeValidation $updateNodeValidation,
        CreateNodeValidation $createNodeValidation
    ) {
        $this->nodeService = $nodeService;
        $this->updateNodeValidation = $updateNodeValidation;
        $this->createNodeValidation = $createNodeValidation;
    }

    /**
     * Fetch all nodes
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $nodes = $this->nodeService->get($request->query('per_page'));
            
            return $this->successResponse($nodes, 'Nodes fetched successfully');
        } catch (Exception $e) {
            return $this->error500Response($e, __METHOD__);
        }
    }

    /**
     * Create new node
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errors = $this->createNodeValidation->validate($request);
        if ($errors) {
            return $this->errorResponse('Validation error', 422, $errors);
        }
        
        try {
            $node = $this->nodeService->create($request->toArray());

            return $this->successResponse($node, 'Node created successfully', 201);
        } catch (Exception $e) {
            return $this->error500Response($e, __METHOD__);
        }
    }

    /**
     * View a single node
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            $node = $this->nodeService->find($id);

            if (! $node) {
                return $this->errorResponse('Node not found', 404);
            }

            return $this->successResponse($node, 'Node fetched successfully');
        } catch (Exception $e) {
            return $this->error500Response($e, __METHOD__);
        }
    }

    /**
     * Update a single node
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $errors = $this->updateNodeValidation->validate($request);
        if ($errors) {
            return $this->errorResponse('Validation error', 422, $errors);
        }

        try {
            $updated = $this->nodeService->update($id, $request->toArray());

            if (! $updated) {
                return $this->errorResponse('Could not update node');
            }

            return $this->successResponse($updated, 'Updated node successfully');
        } catch (Exception $e) {
            return $this->error500Response($e, __METHOD__);
        }
    }

    /**
     * Delete a single node
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $deleted = $this->nodeService->delete($id);

            if (! $deleted) {
                return $this->errorResponse('Could not delete node');
            }

            return $this->successResponse('Node deleted successfully');
        } catch (Exception $e) {
            return $this->error500Response($e, __METHOD__);
        }
    }

}
