<?php 

namespace App\Services;

use App\Models\Node;

class NodeService
{
	/**
     * Class properties
     *
     * @property
     */
    private $node;

	/**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * Get nodes from the database
     *  
     * @param  int|null  $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function get($perPage = 15): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->node->paginate($perPage);
    }

    /**
     * Save a node to the database
     *  
     * @param  array  $data
     * @return \App\Models\Node
     */
    public function create(array $data): \App\Models\Node
    {
        return $this->node::create($data);
    }

    /**
     * Find a node on the database
     *  
     * @param  int  $id
     * @return \App\Models\Node
     */
    public function find(int $id)
    {
        return $this->node->find($id);
    }

    /**
     * Update a node on the database
     *  
     * @param  int  $id
     * @param  array  $data
     * @return \App\Models\Node | null
     */
    public function update(int $id, array $data)
    {
        $node = $this->node->find($id);

        if (! $node) {
            return null;
        }

        return tap($node)->update($data);
    }

    /**
     * Delete a node on the database
     *  
     * @param  int  $id
     * @return \App\Models\Node | null
     */
    public function delete(int $id)
    {
        $node = $this->node->find($id);

        if (! $node) {
            return null;
        }

        return tap($node)->delete();
    }

}