<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title" id="offcanvasExampleLabel">Gestione Notifiche</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  Titolo Notifica + id_cliccabile
                </button>
                {{-- qui bisogna mettere un bottone per reindirizzare alla prenotazione o all'ordine --}}
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <p>Messaggio della notifica</p>
                    <div>Data prenotazione</div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

