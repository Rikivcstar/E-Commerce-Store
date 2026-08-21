    <?php
        $__scriptKey = '3037584329-0';
        ob_start();
    ?>
<script>
    $wire.on('authenticate-with-passkey', async (options) => {
        try {
            const optionsJSON = JSON.parse(options)
            const startAuthenticationResponse = await startAuthentication({ optionsJSON });
            $wire.login(startAuthenticationResponse);
        } catch (e) {
            if (e.name !== 'AbortError') {
                console.error('Passkey authentication failed:', e);
            }
        }
    });
</script>
    <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>

<?php /**PATH C:\laraherd\webstore\vendor\jeffgreco13\filament-breezy\resources\views\livewire\passkeys\authenticate-script.blade.php ENDPATH**/ ?>