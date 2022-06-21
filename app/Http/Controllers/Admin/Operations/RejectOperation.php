<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait RejectOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupRejectRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{id}/reject', [
            'as'        => $routeName . '.reject',
            'uses'      => $controller . '@reject',
            'operation' => 'reject',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupRejectDefaults()
    {
        $this->crud->allowAccess('reject');

        $this->crud->operation('reject', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            // $this->crud->addButton('top', 'reject', 'view', 'crud::buttons.reject');
            $this->crud->addButton('line', 'reject', 'view', 'crud::buttons.reject', 'beginning');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function reject($id)
    {
        $this->crud->hasAccessOrFail('reject');
        $this->crud->model->findOrFail($id)->update([
            'status' => 'Rejected',
        ]);

        return back();
    }
}