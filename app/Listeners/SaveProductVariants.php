<?php

namespace App\Listeners;

use App\Events\ProductSaved;
use App\Repositories\VariantRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveProductVariants
{

    /**
     * @var VariantRepositoryInterface
     */
    private $variant;


    /**
     * Create the event listener.
     *
     * @param VariantRepositoryInterface $variant
     * @return void
     */
    public function __construct(VariantRepositoryInterface $variant)
    {
        $this->variant = $variant;
    }

    /**
     * Handle the event.
     *
     * @param  ProductSaved  $event
     * @return void
     */
    public function handle(ProductSaved $event)
    {
        if(count($event->request->variants)){
            foreach($event->request->variants as $v){
                $variant = $this->variant->newVariant($v);
                $event->product->variants()->save($variant);
            }
        }

        // \Log::info('product saved!', [  'request' => $event->request,
        //                                 'product' => $event->product
        //                             ]);
        // // Find the log in storage/logs/laravel.log
    }
}
