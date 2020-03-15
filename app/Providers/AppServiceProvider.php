<?php

namespace App\Providers;

use Bezhanov\Faker\ProviderCollectionHelper;
use Faker\Generator as Faker;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->extend(Faker::class, function (Faker $faker) {
            ProviderCollectionHelper::addAllProvidersTo($faker);
            return $faker;
        });

        $this->app->extend(ValidatorFactory::class, function (ValidatorFactory $factory) {
            $factory->resolver(function ($translator, $data, $rules, $messages, $customAttributes) {
                $validator = new Validator($translator, $data, $rules, $messages, $customAttributes);

                $validator->setImplicitAttributesFormatter(function ($attribute) {
                    [$group_name, $index, $attribute_name] = explode(".", $attribute);

                    return sprintf("%s %d",
                        __("validation.attributes.{$attribute_name}"),
                        $index + 1,
                    );
                });

                return $validator;
            });
            return $factory;
        });
    }
}
