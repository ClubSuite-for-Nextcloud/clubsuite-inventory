<?php
namespace OCA\ClubSuiteInventory\Controller;

use OCP\AppFramework\OCSController;
use OCP\AppFramework\Http\JSONResponse;
use OCP\IRequest;
use OCA\ClubSuiteInventory\Service\CategoryService;
use OCA\ClubSuiteInventory\Db\CategoryEntity;

class CategoryController extends OCSController {
    private CategoryService $service;

    public function __construct(string $appName, IRequest $request, CategoryService $service) {
        parent::__construct($appName, $request);
        $this->service = $service;
    }

    public function index(): JSONResponse {
        $list = $this->service->listCategories();
        $out = array_map(function($c){ return ['id'=>$c->getId(),'name'=>$c->getName()]; }, $list);
        return new JSONResponse($out, 200);
    }

    public function create(): JSONResponse {
        $p = $this->request->getParams();
        $c = new CategoryEntity($p['name'] ?? '');
        $id = $this->service->createCategory($c);
        return new JSONResponse(['id'=>$id], 201);
    }

    public function update(int $id): JSONResponse {
        $c = $this->service->getCategory($id);
        if ($c === null) return new JSONResponse(['message'=>'Not found'], 404);
        $p = $this->request->getParams();
        if (isset($p['name'])) $c->setName($p['name']);
        $this->service->updateCategory($c);
        return new JSONResponse(['message'=>'ok'], 200);
    }

    public function delete(int $id): JSONResponse {
        $this->service->deleteCategory($id);
        return new JSONResponse(['message'=>'deleted'], 200);
    }
}
