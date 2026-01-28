<?php

declare(strict_types=1);

namespace OCA\ClubSuiteInventory\Controller;

use Exception;
use OCA\ClubSuiteInventory\Db\Item;
use OCA\ClubSuiteInventory\Service\ItemService;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\Response;
use OCP\IRequest;
use OCP\AppFramework\Http\Attribute\NoCSRFRequired;
use OCP\AppFramework\Http\Attribute\NoAdminRequired;
use OCP\AppFramework\Http\Attribute\API;

class ItemApiController extends Controller {

    public function __construct(
        string $appName,
        IRequest $request,
        private ItemService $service
    ) {
        parent::__construct($appName, $request);
    }

    #[NoCSRFRequired]
    #[NoAdminRequired]
    public function index(): DataResponse {
        return new DataResponse($this->service->listItems());
    }

    #[NoCSRFRequired]
    #[NoAdminRequired]
    public function show(int $id): DataResponse {
        try {
            return new DataResponse($this->service->getItem($id));
        } catch (\Throwable $e) {
            return new DataResponse(['error' => $e->getMessage()], 404);
        }
    }

    /* 
     * Correcting the implementation to match the plan.
     */
    #[NoCSRFRequired]
    #[NoAdminRequired]
    public function create(): DataResponse {
        try {
            $data = $this->request->getParams();
            $item = $this->service->createItem($data);
            return new DataResponse($item);
        } catch (Exception $e) {
            return new DataResponse(['error' => $e->getMessage()], 400);
        }
    }

    #[NoCSRFRequired]
    #[NoAdminRequired]
    public function update(int $id): DataResponse {
        try {
            $data = $this->request->getParams();
            $item = $this->service->updateItem($id, $data);
            return new DataResponse($item);
        } catch (Exception $e) {
            return new DataResponse(['error' => $e->getMessage()], 400);
        }
    }

    #[NoCSRFRequired]
    #[NoAdminRequired]
    public function destroy(int $id): DataResponse {
        try {
            $this->service->deleteItem($id);
            return new DataResponse(['status' => 'success']);
        } catch (Exception $e) {
            return new DataResponse(['error' => $e->getMessage()], 400);
        }
    }
}
