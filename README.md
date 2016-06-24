#SDK PHP - Marketplace Grupo Netshoes

Utilizando a SDK PHP, � poss�vel realizar as integra��es necess�rias com o marketplace do Grupo Netshoes de forma �gil e simples.

##Configura��o das Informa��es de Acesso.

Antes de utilizar os recursos da API, � necess�rio realizar as configura��es de base path e tamb�m as credenciais para acesso.
Abaixo segue o c�digo de exemplo:

```php
use ApiMktpNetshoesV1\client\Configuration;
use ApiMktpNetshoesV1\client\ApiClient;

require_once 'ApiMktpNetshoesV1.php';

Configuration::$apiKey['client_id'] = 'Xd2UvK0niRme';
Configuration::$apiKey['access_token'] = 'Kv6INdp01EvQ';

$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
```

##Tratamento de Erro

Tratamento de estruturas de erros recebidas nas chamadas a API:

```php
function deserializeError ($errorJson, $apiClient) {

	$error = null;

	try {
		$error = $apiClient->deserialize(json_decode($errorJson), 'ErrorResource');
	} catch (\Exception $e) {}

	return $error;

}
```

##Recursos Dispon�veis

A seguir, ser� apresentada a API e exemplos com as as principais opera��es do Marketplace do Grupo Netshoes.

###Product Template API

Cont�m os recursos utilizados para aux�lio na configura��o dos produtos que ser�o enviados ao marketplace.

####Lista de Departamentos
```php
$products_templates_api = new ProductsTemplatesApi($api_client);

try {
	
	$department_list_resource = $products_templates_api->listDepartments("NS");
	var_dump($department_list_resource);

} catch (ApiException $e) {
	echo ($e->getMessage());
}
```

####Lista de Tipos de Produtos
```php
$products_templates_api = new ProductsTemplatesApi($api_client);

try {

	$product_type_list_resource = $products_templates_api->listProductTypes(10);
	var_dump($product_type_list_resource);

} catch (ApiException $e) {
	echo ($e->getMessage());
}
```

####Lista de Marcas
```php
$products_templates_api = new ProductsTemplatesApi($api_client);

try {

	$brand_list_resource = $products_templates_api->listBrands();
	var_dump($brand_list_resource);

} catch (ApiException $e) {
	echo ($e->getMessage());
}
```

####Lista de Tamanhos
```php
$products_templates_api = new ProductsTemplatesApi($api_client);

try {

	$size_list_resource = $products_templates_api->listSizes();
	var_dump($size_list_resource);

} catch (ApiException $e) {
	echo ($e->getMessage());
}
```

####Lista de Sabores
```php
$products_templates_api = new ProductsTemplatesApi($api_client);

try {

	$flavor_list_resource = $products_templates_api->listFlavors();
	var_dump($flavor_list_resource);

} catch (ApiException $e) {
	echo ($e->getMessage());
}
```

####Lista de Cores
```php
$products_templates_api = new ProductsTemplatesApi($api_client);

try {

	$color_list_resource = $products_templates_api->listColors();
	var_dump($color_list_resource);

} catch (ApiException $e) {
	echo ($e->getMessage());
}
```

####Lista de Templates
```php
$products_templates_api = new ProductsTemplatesApi($api_client);

try {

	$template_list_resource = $products_templates_api->listTemplates(10, 4);
	var_dump($template_list_resource);

} catch (ApiException $e) {
	echo ($e->getMessage());
}
```

###Products API

Cont�m os recursos utilizados para cria��o e altera��o de produtos enviados ao marketplace.

#### Cria��o de Novos Produtos

```php
$product_resource = new ProductResource();
$product_resource->product_id = '12346';
$product_resource->department = 'Futebol';
$product_resource->product_type = 'Agasalhos';
$product_resource->brand = 'Adidas';

$attribute_resource = new AttributeResource();
$attribute_resource->name = 'SEXO';
$attribute_resource->value = 'F';

$product_resource->attributes = array(
	$attribute_resource
);

$product_resource->skus = array();

$sku_resource = new SkuResource();
$sku_resource->sku = '111-0457-289-40';
$sku_resource->name = 'Agasalho Teste 01 Adidas';
$sku_resource->description = 'Agasalho, Branco, Adidas';
$sku_resource->color = 'Branco';
$sku_resource->gender = 'Mulher';
$sku_resource->size = 'G';
$sku_resource->ean_isbn = '16598198';

$image_resource = new ImageResource();
$image_resource->url = 'http://7-themes.com/data_images/out/42/6914793-tropical-beach-images.jpg';
$sku_resource->images = array (
	$image_resource
);

$sku_resource->video = 'http://video/video1';
$sku_resource->height = 20.0;
$sku_resource->width = 10.0;
$sku_resource->depth = 44.0;
$sku_resource->weight = 65.0;

array_push($product_resource->skus, $sku_resource);

$sku_resource = new SkuResource();
$sku_resource->sku = '111-0457-289-41';
$sku_resource->name = 'Agasalho Teste 01 Adidas';
$sku_resource->description = 'Agasalho, Branco, Adidas';
$sku_resource->color = 'Branco';
$sku_resource->gender = 'Mulher';
$sku_resource->size = 'M';
$sku_resource->ean_isbn = '16598198';

$image_resource = new ImageResource();
$image_resource->url = 'http://7-themes.com/data_images/out/42/6914793-tropical-beach-images.jpg';
$sku_resource->images = array (
		$image_resource
);

$sku_resource->video = 'http://video/video1';
$sku_resource->height = 20.0;
$sku_resource->width = 10.0;
$sku_resource->depth = 44.0;
$sku_resource->weight = 65.0;

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
```

###SKUs API

Cont�m os recursos utilizados para checagem de SKUs relacionados aos produtos enviados ao marketplace.

####Verifica��o do Status de Sincroniza��o Com o Marketplace

Ap�s fazer o envio dos seus produtos no exemplo anterior, voc� poder� fazer a verifica��o de sincroniza��o com o marketplace:

```php
$skus_api = new SkusApi($api_client);

try {
	$business_unit_response = $skus_api->getStatus('111-0457-289-40', 'NS');
	var_dump($business_unit_response);
} catch (ApiException $e) {
	echo ($e->getMessage());
}
```

Isso indica que seus produtos j� podem ser comercializados nos portais de venda.
Mas antes, � necess�rio realizar os procedimentos de atualiza��o de estoque, pre�o e status, conforme exibido nos exemplos abaixo:

####Configura��o de Estoque

```php
$skus_api = new SkusApi($api_client);

$stock_resource = new StockResource();
$stock_resource->available = 20.0;
$stock_resource->country = 'BR';

try {
	$stock_response = $skus_api->updateStock('111-0457-289-40', $stock_resource);
	var_dump($stock_response);
} catch (ApiException $e) {
	echo ($e->getMessage());
}
```

####Configura��o de Pre�o

```php
$skus_api = new SkusApi($api_client);

$price_resource = new PriceResource();
$price_resource->price = 100.0;

try {
	$price_response = $skus_api->updatePrice('111-0457-289-40', $price_resource);
	var_dump($price_response);
} catch (ApiException $e) {
	echo ($e->getMessage());
}
```

####Ativa��o do Produto para Venda

```php
$skus_api = new SkusApi($api_client);

$business_unit_resource = new BusinessUnitResource();
$business_unit_resource->active = TRUE;

try {
	$business_unit_response = $skus_api->updateStatus('111-0457-289-40', 'NS', $business_unit_resource);
	var_dump($business_unit_response);
} catch (ApiException $e) {
	echo ($e->getMessage());
}
```

###Orders API

Agora que os produtos j� est�o dispon�veis para venda, � poss�vel fazer a consulta de ordens geradas nos portais de venda Netshoes e Zattini.

```php
$orders_api = new OrdersApi($api_client);

try {
	
	// Lista as ordens de D-1
	$order_list_resource = $orders_api->listOrders(0, 20, null,
			(new \DateTime('NOW'))->sub(new \DateInterval('P1D')), new \DateTime('NOW'),
			'Faturado', 'Venda');

	var_dump($order_list_resource);

} catch (ApiException $e) {
	$error_resource = deserializeError($e->getResponseBody(), $api_client);
	if ($error_resource == null) {
		var_dump($e);
	} else {
		var_dump($error_resource);
	}
}
```
