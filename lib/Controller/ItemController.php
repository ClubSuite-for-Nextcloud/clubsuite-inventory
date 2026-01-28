<?php
namespace OCA\ClubSuiteInventory\Controller;

use OCP\AppFramework\OCSController;
use OCP\AppFramework\Http\JSONResponse;
use OCP\IRequest;
use OCA\ClubSuiteInventory\Service\ItemService;
use OCA\ClubSuiteInventory\Db\ItemEntity;

class ItemController extends OCSController {
    private ItemService $service;

    public function __construct(string $appName, IRequest $request, ItemService $service) {
        parent::__construct($appName, $request);
        $this->service = $service;
    }

    public function index(): JSONResponse {
        $list = $this->service->listItems();
        $out = array_map(function($i){ return ['id'=>$i->getId(),'name'=>$i->getName(),'category_id'=>$i->getCategoryId()]; }, $list);
            $limit = (int)$this->request->getParam('limit', 50);
            $offset = (int)$this->request->getParam('offset', 0);
            $sort = $this->request->getParam('sort', 'name');
            $order = $this->request->getParam('order', 'ASC');

            $service = new \OCA\ClubSuiteInventory\Service\ItemService($this->mapper);
            $result = $service->listItemsPaginated($limit, $offset, $sort, $order);
            return new \OCP\AppFramework\Http\JSONResponse($result);
    }

    public function create(): JSONResponse {
        $p = $this->request->getParams();
        $i = new ItemEntity($p['name'] ?? '');
        $i->setDescription($p['description'] ?? null);
        $i->setCategoryId(isset($p['category_id']) ? (int)$p['category_id'] : null);
        $id = $this->service->createItem($i);
        return new JSONResponse(['id'=>$id], 201);
    }

    public function show(int $id): JSONResponse {
        $i = $this->service->getItem($id);
        if ($i === null) return new JSONResponse(['message'=>'Not found'], 404);
        return new JSONResponse(['id'=>$i->getId(),'name'=>$i->getName(),'description'=>$i->getDescription()], 200);
    }

    public function update(int $id): JSONResponse {
        $i = $this->service->getItem($id);
        if ($i === null) return new JSONResponse(['message'=>'Not found'], 404);
        $p = $this->request->getParams();
        if (isset($p['name'])) $i->setName($p['name']);
        if (array_key_exists('description', $p)) $i->setDescription($p['description']);
        if (isset($p['category_id'])) $i->setCategoryId((int)$p['category_id']);
        $this->service->updateItem($i);
        return new JSONResponse(['message'=>'ok'], 200);
    }

    public function delete(int $id): JSONResponse {
        $this->service->deleteItem($id);
        return new JSONResponse(['message'=>'deleted'], 200);
    }
}
