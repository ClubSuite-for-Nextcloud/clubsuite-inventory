Inter-App Communication (Inventar)

Dieses Dokument beschreibt das Event- und Callback-Modell für Inventar.

Model: Basic, Callback, RequestData

Beispiel Sender:
```
$eventService->dispatchBasicEvent(['sku'=>'123']);
```

Beispiel Listener:
```
public function handle(CallbackEvent $e) { $e->triggerCallback(['ok'=>true]); }
```
