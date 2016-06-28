<?php

use ApiMktpNetshoesV1\client\Configuration;

#API
use ApiMktpNetshoesV1\client\ApiClient;
use ApiMktpNetshoesV1\ProductsTemplatesApi;
use ApiMktpNetshoesV1\ProductsApi;
use ApiMktpNetshoesV1\SkusApi;
use ApiMktpNetshoesV1\OrdersApi;

#Recursos
use ApiMktpNetshoesV1\Model\ProductResource;
use ApiMktpNetshoesV1\Model\AttributeResource;
use ApiMktpNetshoesV1\Model\SkuResource;
use ApiMktpNetshoesV1\Model\ImageResource;
use ApiMktpNetshoesV1\Model\PriceResource;
use ApiMktpNetshoesV1\Model\StockResource;

require_once 'ApiMktpNetshoesV1.php';

/**
*
*/
class Netshoes
{

	public function criarProduto($listProdutos)
	{

		Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
		Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

		$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');

		$product_resource = new ProductResource();
		$product_resource->product_id = $listProdutos['sku'];
		$product_resource->department = $listProdutos['categoriaPai'];
		$product_resource->product_type = $listProdutos['categoriaFinal'];
		$product_resource->brand = $listProdutos['marca'];

		$product_resource->skus = array();

		$sku_resource = new SkuResource();
		$sku_resource->sku = $listProdutos['sku'];
		$sku_resource->name = $listProdutos['nome'];
		$sku_resource->description = $listProdutos['descricao'];
		$sku_resource->color = $listProdutos['cor'];
		$sku_resource->gender = $listProdutos['gender'];
		$sku_resource->size = $listProdutos['tamanho'];
		$sku_resource->ean_isbn = $listProdutos['ean'];

		$image_resource = new ImageResource();
		$image_resource->url = $listProdutos['imgUrl'];
		$sku_resource->images = array (
			$image_resource
			);

		$sku_resource->height =$listProdutos['altura'];
		$sku_resource->width = $listProdutos['largura'];
		$sku_resource->depth = $listProdutos['profundidade'];
		$sku_resource->weight = $listProdutos['peso'];

		array_push($product_resource->skus, $sku_resource);


		$products_api = new ProductsApi($api_client);
		try {
			$product_response = $products_api->saveProduct($product_resource);
			var_dump($product_response);

		} catch (ApiException $e) {
			$error_resource = deserializeError($e->getResponseBody(), $api_client);
			if ($error_resource == null) {
				var_dump($e);
			} else {
				var_dump($error_resource);
			}
		}

	}

	public function atualizaPreco($sku, $preco)
	{
		Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
		Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

		$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');

		$skus_api = new SkusApi($api_client);

		$price_resource = new PriceResource();
		$price_resource->price = $preco;

		try {
			$price_response = $skus_api->updatePrice($sku, $price_resource);
			var_dump($price_response);
		} catch (ApiException $e) {
			echo ($e->getMessage());
		}
	}

	public function atualizaEstoque($sku, $qnt)
	{
		Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
		Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

		$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');

		$skus_api = new SkusApi($api_client);

		$stock_resource = new StockResource();
		$stock_resource->available = $qnt;
		$stock_resource->country = 'BR';
		var_dump($stock_resource);

		try {
			$stock_response = $skus_api->updateStock($sku, $stock_resource);
			var_dump($stock_response);
		} catch (ApiException $e) {
			echo ($e->getMessage());
		}
	}

	public function recebeOrders()
	{
		Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
		Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

		$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
		$orders_api = new OrdersApi($api_client);

		try {
		// Lista as ordens de D-1
			$order_list_resource = $orders_api->listOrders(0, 20, 'shippings',null,null,
				'Created', 'Venda');

			var_dump($order_list_resource);

		} catch (ApiException $e) {
			$error_resource = deserializeError($e->getResponseBody(), $api_client);
			if ($error_resource == null) {
				var_dump($e);
			} else {
				var_dump($error_resource);
			}
		}
	}

	public function listarProdutos($page, $size, $expand)
	{
		Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
		Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

		$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
		$products_api = new ProductsApi($api_client);
		try {

			$product_response = $products_api->listProducts($page, $size, $expand);
			//var_dump($product_response->items);

			foreach ($product_response->items as $key) {
				foreach ($key as $key => $value) {
					var_dump($value);
				}
			}
		} catch (ApiException $e) {
			$error_resource = deserializeError($e->getResponseBody(), $api_client);
			if ($error_resource == null) {
				var_dump($e);
			} else {
				var_dump($error_resource);
			}
		}
	}

	public function listarDepartamentos()
	{
		Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
		Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

		$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
		$products_templates_api = new ProductsTemplatesApi($api_client);

		try {

		    $department_list_resource = $products_templates_api->listDepartments("NS");
		    var_dump($department_list_resource);

		} catch (ApiException $e) {
		    echo ($e->getMessage());
		}
	}

	function patchProduct($listProdutos , $sku)
	{
		Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
		Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

		$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');

		$product_resource = new ProductResource();
		$product_resource->product_id = $listProdutos['sku'];
		$product_resource->department = $listProdutos['categoriaPai'];
		$product_resource->product_type = $listProdutos['categoriaFinal'];
		$product_resource->brand = $listProdutos['marca'];

		$product_resource->skus = array();

		$sku_resource = new SkuResource();
		$sku_resource->sku = $listProdutos['sku'];
		$sku_resource->name = $listProdutos['nome'];
		$sku_resource->description = $listProdutos['descricao'];
		$sku_resource->color = $listProdutos['cor'];
		$sku_resource->gender = $listProdutos['gender'];
		$sku_resource->size = $listProdutos['tamanho'];
		$sku_resource->ean_isbn = $listProdutos['ean'];

		$image_resource = new ImageResource();
		$image_resource->url = $listProdutos['imgUrl'];
		$sku_resource->images = array (
			$image_resource
			);

		$sku_resource->height =$listProdutos['altura'];
		$sku_resource->width = $listProdutos['largura'];
		$sku_resource->depth = $listProdutos['profundidade'];
		$sku_resource->weight = $listProdutos['peso'];

		array_push($product_resource->skus, $sku_resource);


		$products_api = new ProductsApi($api_client);
		try {
			$product_response = $products_api->patchProduct($sku, $product_resource);
			var_dump($product_response);

		} catch (ApiException $e) {
			$error_resource = deserializeError($e->getResponseBody(), $api_client);
			if ($error_resource == null) {
				var_dump($e);
			} else {
				var_dump($error_resource);
			}
		}
	}

	function updateProduct($listProdutos , $sku)
	{
		Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
		Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

		$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');

		$product_resource = new ProductResource();
		$product_resource->product_id = $listProdutos['sku'];
		$product_resource->department = $listProdutos['categoriaPai'];
		$product_resource->product_type = $listProdutos['categoriaFinal'];
		$product_resource->brand = $listProdutos['marca'];

		$product_resource->skus = array();

		$sku_resource = new SkuResource();
		$sku_resource->sku = $listProdutos['sku'];
		$sku_resource->name = $listProdutos['nome'];
		$sku_resource->description = $listProdutos['descricao'];
		$sku_resource->color = $listProdutos['cor'];
		$sku_resource->gender = $listProdutos['gender'];
		$sku_resource->size = $listProdutos['tamanho'];
		$sku_resource->ean_isbn = $listProdutos['ean'];

		$image_resource = new ImageResource();
		$image_resource->url = $listProdutos['imgUrl'];
		$sku_resource->images = array (
			$image_resource
			);

		$sku_resource->height =$listProdutos['altura'];
		$sku_resource->width = $listProdutos['largura'];
		$sku_resource->depth = $listProdutos['profundidade'];
		$sku_resource->weight = $listProdutos['peso'];

		array_push($product_resource->skus, $sku_resource);


		$products_api = new ProductsApi($api_client);
		try {
			$product_response = $products_api->updateProduct($sku, $product_resource);
			var_dump($product_response);

		} catch (ApiException $e) {
			$error_resource = deserializeError($e->getResponseBody(), $api_client);
			if ($error_resource == null) {
				var_dump($e);
			} else {
				var_dump($error_resource);
			}
		}
	}
}

$netshoes = new Netshoes();
$listaDeProduto = array(
	'sku' => 'Z0077AAMX' ,
	'categoriaPai' => 'Tennis e Squash',
	'categoriaFinal' => 'Garrafas',
	'marca' => 'Wilson',
	'nome' => 'Garrafa Wilson 500ML Azul - Wilson',
	'descricao' => 'A Garrafa Wilson 500 ml Natural é a forma mais prática para armazenar água, isotônico ou sucos.',
	'cor' => 'Azul',
	'gender' => 'Unissex',
	'tamanho' =>'G',
	'ean' => '7897135800895',
	'imgUrl' => 'http://www.polihouse.com.br/media/extendware/ewimageopt/media/inline/28/8/garrafa-wilson-500ml-amarelo-wilson-53e.jpg',
	'altura' => '15',
	'largura' => '15',
	'profundidade' => '15',
	'peso' =>  '100');

$sku = 'Z0077AAM';
//$netshoes->criarProduto($listaDeProduto);
//$netshoes->atualizaPreco('7891437342374','407.00');
//$netshoes->atualizaEstoque('7891437342374', '30');
//$netshoes->recebeOrders();
//$netshoes->listarDepartamentos();
//$netshoes->patchProduct($listaDeProduto , $sku);
//$netshoes->updateProduct($listaDeProduto , $sku);
//$netshoes->listarProdutos(0,100,'items');