<?php
namespace Dinvoice\Http\Controllers\V1\Expense;

use Dinvoice\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Dinvoice\Http\Requests\ExpenseCategoryRequest;
use Dinvoice\Http\Controllers\Controller;

class ExpenseCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->has('limit') ? $request->limit : 5;

        $categories = ExpenseCategory::whereCompany($request->header('company'))
            ->applyFilters($request->only([
                'category_id',
                'search'
            ]))
            ->latest()
            ->paginateData($limit);

        return response()->json([
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseCategoryRequest $request)
    {
        $data = $request->validated();
        $data['company_id'] = $request->header('company');
        $category = ExpenseCategory::create($data);

        return response()->json([
            'category' => $category,
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Dinvoice\Models\ExpenseCategory $category
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCategory $category)
    {
        return response()->json([
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Dinvoice\Models\ExpenseCategory $ExpenseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseCategoryRequest $request, ExpenseCategory $category)
    {
        $category->update($request->validated());

        return response()->json([
            'category' => $category,
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Dinvoice\ExpensesCategory $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $category)
    {
        if ($category->expenses() && $category->expenses()->count() > 0) {
            return response()->json([
                'success' => false
            ]);
        }

        $category->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
