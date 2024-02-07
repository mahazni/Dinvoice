<?php

namespace Dinvoice\Http\Controllers\V1\Item;

use Dinvoice\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dinvoice\Http\Requests;
use Dinvoice\Http\Requests\DeleteItemsRequest;
use Dinvoice\Models\Item;
use Dinvoice\Models\TaxType;

class ItemsController extends Controller
{
    /**
     * Retrieve a list of existing Items.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->has('limit') ? $request->limit : 10;

        $items = Item::with(['taxes', 'creator'])
            ->leftJoin('units', 'units.id', '=', 'items.unit_id')
            ->applyFilters($request->only([
                'search',
                'price',
                'unit_id',
                'item_id',
                'orderByField',
                'orderBy'
            ]))
            ->whereCompany($request->header('company'))
            ->select('items.*', 'units.name as unit_name')
            ->latest()
            ->paginateData($limit);

        return response()->json([
            'items' => $items,
            'taxTypes' => TaxType::latest()->get(),
            'itemTotalCount' => Item::count()
        ]);
    }

    /**
     * Create Item.
     *
     * @param  Dinvoice\Http\Requests\ItemsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Requests\ItemsRequest $request)
    {
        $item = Item::createItem($request);

        return response()->json([
            'item' => $item
        ]);
    }

    /**
     * get an existing Item.
     *
     * @param  Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Item $item)
    {
        $item->load('taxes');

        return response()->json([
            'item' => $item
        ]);
    }

    /**
     * Update an existing Item.
     *
     * @param  Dinvoice\Http\Requests\ItemsRequest $request
     * @param  \Dinvoice\Models\Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Requests\ItemsRequest $request, Item $item)
    {
        $item = $item->updateItem($request);

        return response()->json([
            'item' => $item
        ]);
    }

    /**
     * Delete a list of existing Items.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(DeleteItemsRequest $request)
    {
        Item::destroy($request->ids);

        return response()->json([
            'success' => true
        ]);
    }
}
