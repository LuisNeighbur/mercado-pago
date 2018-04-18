<?php 
namespace EnlineaLab\MercadoPago\Providers;

use Illuminate\Support\ServiceProvider;
use LivePixel\MercadoPago\MP;

class MercadoPagoServiceProvider extends ServiceProvider 
{

	protected $mp_app_id;
	protected $mp_app_secret;

	public function boot()
	{
		
		$this->publishes([__DIR__.'/../resources/config/mercadopago.php' => config_path('mercadopago.php')]);

		$this->mp_app_id     = config('mercadopago.app_id');
		$this->mp_app_secret = config('mercadopago.app_secret');
		$this->mp_sandbox_mode = config('mercadopago.sanbdox_mode');
	}

	public function register()
	{
		$this->app->singleton('MP', function(){
			$mp = new MP($this->mp_app_id, $this->mp_app_secret);
			$mp->sandbox_mode($this->mp_sandbox_mode);
			return $mp;
		});
	}
}