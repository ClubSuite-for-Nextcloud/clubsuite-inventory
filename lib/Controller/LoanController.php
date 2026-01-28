<?php
namespace OCA\ClubSuiteInventory\Controller;

use OCP\AppFramework\OCSController;
use OCP\AppFramework\Http\JSONResponse;
use OCP\IRequest;
use OCA\ClubSuiteInventory\Service\LoanService;
use OCA\ClubSuiteInventory\Db\LoanEntity;

class LoanController extends OCSController {
    private LoanService $service;

    public function __construct(string $appName, IRequest $request, LoanService $service) {
        parent::__construct($appName, $request);
        $this->service = $service;
    }

    public function index(): JSONResponse {
        $list = $this->service->listLoans();
        $out = array_map(function($l){ return ['id'=>$l->getId(),'item_id'=>$l->getItemId(),'user_id'=>$l->getUserId(),'loan_date'=>$l->getLoanDate()->format('Y-m-d H:i:s'),'status'=>$l->getStatus()]; }, $list);
        return new JSONResponse($out, 200);
    }

    public function create(): JSONResponse {
        $p = $this->request->getParams();
        $l = new LoanEntity((int)$p['item_id'], $p['user_id'] ?? '', new \DateTime($p['loan_date'] ?? 'now'));
        $l->setReturnDate(!empty($p['return_date']) ? new \DateTime($p['return_date']) : null);
        $l->setStatus($p['status'] ?? null);
        $id = $this->service->createLoan($l);
        return new JSONResponse(['id'=>$id], 201);
    }

    public function show(int $id): JSONResponse {
        $l = $this->service->getLoan($id);
        if ($l === null) return new JSONResponse(['message'=>'Not found'], 404);
        return new JSONResponse(['id'=>$l->getId(),'item_id'=>$l->getItemId(),'user_id'=>$l->getUserId()], 200);
    }

    public function update(int $id): JSONResponse {
        $l = $this->service->getLoan($id);
        if ($l === null) return new JSONResponse(['message'=>'Not found'], 404);
        $p = $this->request->getParams();
        if (!empty($p['return_date'])) $l->setReturnDate(new \DateTime($p['return_date']));
        if (array_key_exists('status', $p)) $l->setStatus($p['status']);
        $this->service->updateLoan($l);
        return new JSONResponse(['message'=>'ok'], 200);
    }

    public function delete(int $id): JSONResponse {
        $this->service->deleteLoan($id);
        return new JSONResponse(['message'=>'deleted'], 200);
    }
}
