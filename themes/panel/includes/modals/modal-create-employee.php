<!--begin::Modal - Users Search-->
<div class="modal fade" id="kt_modal_create_employee" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <!--begin::Content-->
                <div class="text-center mb-13">
                    <h1 class="mb-3">Novo Funcionário</h1>
                    <div class="text-muted fw-semibold fs-5">Preencha o formulário abaixo para cadastrar um
                        funcionário
                    </div>
                </div>
                <!--end::Content-->
                <!--begin::Search-->
                <div id="kt_modal_users_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2"
                     data-kt-search-enter="enter" data-kt-search-layout="inline">
                    <!--begin::Form-->
                    <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">
                        <!--begin::Hidden input(Added to disable form autocomplete)-->
                        <input type="hidden"/>
                        <!--end::Hidden input-->

                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4">Nome Completo</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                 <span class="fw-bold fs-8 text-gray-800 me-2">
                                     <input class="form-control" type="text" placeholder="Digite o nome completo"
                                            value="">
                                 </span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4">Login</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                 <span class="fw-bold fs-8 text-gray-800 me-2">
                                     <input class="form-control" type="text" placeholder="Login para acessar o sistema"
                                            value="">
                                 </span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4">Senha</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                 <span class="fw-bold fs-8 text-gray-800 me-2">
                                     <input class="form-control" type="text" placeholder="Digite uma senha simples"
                                            value="">
                                 </span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4">Repita a Senha</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                 <span class="fw-bold fs-8 text-gray-800 me-2">
                                     <input class="form-control" type="text" placeholder="Repita a senha digitada acima"
                                            value="">
                                 </span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4">Documento (CPF)</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                 <span class="fw-bold fs-8 text-gray-800 me-2">
                                     <input class="form-control" type="text" placeholder="Digite somente os números"
                                            value="">
                                 </span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4">Data de Nascimento</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                 <span class="fw-bold fs-8 text-gray-800 me-2">
                                     <input class="form-control" type="text" placeholder="Digite somente os números"
                                            value="">
                                 </span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4">Nível de Acesso</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                 <span class="fw-bold fs-8 text-gray-800 me-2">
                                     <select name="currnecy" class="form-control form-select form-select-solid form-select-lg">
																<option style="padding: 10px" value="">Selecione um nível de acesso..</option>
                                         <?php for ($i = 1; $i <= 10; $i++): ?>
                                             <option style="padding: 10px" value="<?= $i; ?>">Opção <?= $i; ?></option>
                                         <?php endfor; ?>

															</select>
                                 </span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4">Cargo</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                 <span class="fw-bold fs-8 text-gray-800 me-2">
                                     <input class="form-control" type="text"
                                            placeholder="Digite o cargo de seu funcionário" value="">
                                 </span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-semibold text-muted"></label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800 me-2"><button
                                                                class="btn btn-success"><?= icon("database"); ?> Cadastrar Funcionário</button></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                    </form>
                    <!--end::Form-->
                    <!--end::Wrapper-->
                </div>
                <!--end::Search-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Users Search-->