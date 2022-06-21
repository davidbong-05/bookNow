<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait ApproveOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupApproveRoutes($segment, $routeName, $controller)
    {
        Route::GET($segment . '/{id}/approve', [
            'as'        => $routeName . '.approve',
            'uses'      => $controller . '@approve',
            'operation' => 'approve',
        ]);
    }
    protected function setupApproveDefaults()
    {
        $this->crud->allowAccess('approve');

        $this->crud->operation('approve', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            $this->crud->addButton('line', 'approve', 'view', 'crud::buttons.approve', 'beginning');
        });
    }

    public function approve($id)
    {
        $this->crud->hasAccessOrFail('approve');
        $this->crud->model->findOrFail($id)->update([
            'status' => 'Approved',
        ]);

        return back();
    }
}