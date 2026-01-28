<?php
namespace OCA\ClubSuiteInventory\Service;

/**
 * Stub QR code service. In production use a library like Endroid/QrCode.
 */
class QRCodeService {
    public function generateForItem(int $itemId): string {
        // Minimal placeholder: return a text-based code. Replace with real QR generation.
        return 'inventar:item:' . $itemId;
    }
}
