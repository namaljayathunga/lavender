<?php
namespace App\Workflow\Handlers\Backend;

use App\Support\Facades\Message;
use Lavender\Contracts\Workflow;

class EditProduct
{

    /**
     * @param $data
     */
    public function handle(Workflow $data)
    {
        $request = $data->request;

        $product = $data->product;

        $product->update($request);

        Message::addSuccess(sprintf(
            "Product \"%s\" was updated.",
            $product->name
        ));
    }

    /**
     * @param $data
     */
    public function categories(Workflow $data)
    {
        $request = $data->request;

        $product = $data->product;

        //todo fix detach / update (doesn't work sequentially without cloning entity)
        $cloned = clone $product;
        $cloned->categories()->detach();

        $product->update(['categories' => ['category' => $request['categories']]]);

        Message::addSuccess(sprintf(
            "Product \"%s\" was updated.",
            $product->name
        ));
    }

}