    <!-- Modal modal tarjetas -->
    <div class="modal fade modal-custom-comprar" id="modal-tarjetas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Selecciona tu tarjeta</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">

                      <div class="select-tarjeta">

                          <div class="card-tarjeta">
                              <input type="radio" name="radio">
                              <span class="checkmark"><i class="fas fa-check"></i></span>
                              <div class="card-div card-mastercard">
                                  <div class="card-info">
                                      <img class="placa" src="/dashboard/assets/img/perfil/placa.png" alt="">
                                      <p class="mt-1 mt-lg-2 mb-1"> 
                                          <span class="mr-3">**** </span> <span class="mr-3">**** </span> <span class="mr-3">**** </span> 
                                          <strong >2345</strong>
                                      </p>
                                      <small class="m-0">EXP: 12/28</small>
                                      <div class="d-flex justify-content-between align-items-center">
                                          <p class="my-0">Nombre completo</p>
                                          <img class="img-fluid" src="/dashboard/assets/img/comprar/mastercard.png" alt="">
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="card-tarjeta">
                              <input type="radio" name="radio">
                              <span class="checkmark"><i class="fas fa-check"></i></span>
                              <div class="card-div  card-visa">
                                  <div class="card-info">
                                      <img class="placa" src="/dashboard/assets/img/perfil/placa.png" alt="">
                                      <p class="mt-2 mb-1"> 
                                          <span class="mr-3">**** </span> <span class="mr-3">**** </span> <span class="mr-3">**** </span> 
                                          <strong >2345</strong>
                                      </p>
                                      <small>EXP: 12/28</small>
                                      <div class="d-flex justify-content-between align-items-center py-2">
                                          <p class="my-0">Nombre completo</p>
                                          <img class="img-fluid" src="/dashboard/assets/img/comprar/visa.png" alt="">
                                      </div>
                                  </div>
                              </div>
                          </div>


                      </div>

                      <a href="#" class="btn-add-tarjeta  mx-auto mt-3"  >
                          <span><img src="/dashboard/assets/img/deposito/Mask.png" alt=""></span> 
                          Agregar nueva tarjeta
                      </a>


                  </div>
                  <div class="modal-footer" >
                  <button type="button" class="btn text-white btn-info-gradient  mx-auto">Selecionar tarjeta</button>
                  </div>
              </div>
          </div>
      </div>