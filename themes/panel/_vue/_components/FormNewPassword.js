import {SYSTEM_URL, API_URL, PASSWORD_LIMIT} from './../CONFIG.js'
import LoadingButton from "./LoadingButton.js";

const FormNewPassword = Vue.component('formnewpassword', {

    // propriedades vindas do elemento pai
    props: ["usercode"],

    // informações de retorno para o componente
    data: function () {

        return {
            userData: {
                password: "",
                confirmPassword: "",
                code: this.usercode
            },
            checkValidate: true,
            txtMessage: '',
            messageClass: '',
            dangerClass: ' alert alert-danger ',
            successClass: ' alert alert-success ',
            display: 'display: none'
        }
    },

    mounted: function () {

        this.$refs.password.focus();
    },

    // metodos
    methods: {
        resetForm() {
            this.userData.password = ''
            this.userData.confirmPassword = ''
            this.userData.code = ''
        },

        newPassword(event) {
            event.preventDefault();
            this.display = 'display: block'

            if (this.userData.password === '') {
                this.txtMessage = 'Preencha o campo Nova Senha'
                this.checkValidate = false;
                this.changeMessageClass();
                this.display = 'display: none'
                return
            }

            if (this.userData.confirmPassword === '') {
                this.txtMessage = 'Preencha o campo Confirme a Nova Senha'
                this.checkValidate = false;
                this.changeMessageClass();
                this.display = 'display: none'
                return
            }

            axios
                .post(`${API_URL()}/newPassword`, this.userData)
                .then(response => {
                    const {data} = response

                    if (data.error) {
                        this.txtMessage = data.error
                        this.checkValidate = false;
                        this.changeMessageClass();
                    }

                    if (data.success) {
                        this.txtMessage = data.success
                        this.checkValidate = true;
                        this.changeMessageClass();
                        this.resetForm()
                    }
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {

                    this.display = 'display: none'
                    console.clear();
                    console.log('End of routine')
                })

        },
        changeMessageClass: function () {
            if (this.checkValidate === false) {
                this.messageClass = this.dangerClass
            } else {
                this.messageClass = this.successClass
            }
        }
    },

    // componentes
    components: {
        LoadingButton: LoadingButton,
    },

    // renderização
    template: `   

        <!--begin::Form-->
							<form v-on:submit="newPassword" ref="formNewPassword" class="form w-100" novalidate="novalidate" id="kt_new_password_form">
							
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">Cadastre sua nova senha</h1>
									<!--end::Title-->
									<!--begin::Link-->
									<div class="text-gray-400 fw-semibold fs-4">Já recuperou sua senha ?
									<a href="../dist/authentication/sign-in/basic.html" class="link-primary fw-bold">Efetue Login</a></div>
									<!--end::Link-->
								</div>
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="mb-10 fv-row" data-kt-password-meter="true">
									<!--begin::Wrapper-->
									<div class="mb-1">
										<!--begin::Label-->
										<label class="form-label fw-bold text-dark fs-6">Nova Senha</label>
										<!--end::Label-->
										<!--begin::Input wrapper-->
										<div class="position-relative mb-3">
											 <input ref="password" v-model="userData.password" class="form-control form-control-lg form-control-solid" type="password"
                                           placeholder="********"  autocomplete="off"/>
											<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
												<i class="ki-duotone ki-eye-slash fs-2"></i>
												<i class="ki-duotone ki-eye fs-2 d-none"></i>
											</span>
										</div>
										<!--end::Input wrapper-->
										<!--begin::Meter-->
										<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
										</div>
										<!--end::Meter-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Hint-->
									<div class="text-muted">Sua senha deve conter entre ${PASSWORD_LIMIT('min')} e ${PASSWORD_LIMIT('max')} caracteres.</div>
									<!--end::Hint-->
								</div>
								<!--end::Input group=-->
								<!--begin::Input group=-->
								<div class="fv-row mb-10">
									<label class="form-label fw-bold text-dark fs-6">Confirme a Nova Senha</label>
									<input ref="confirmPassword" v-model="userData.confirmPassword" class="form-control form-control-lg form-control-solid" type="password"
                                   placeholder="********" autocomplete="off"/>
								</div>
								<!--end::Input group=-->
								<div id="loadResponse" :class="messageClass">{{txtMessage}}</div>
								<!--begin::Action-->
								<div class="text-center">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label"><i class="fa fa-lock"></i> Salvar Nova Senha</span>
                                <LoadingButton :display="display" />
                            </button>
								</div>
								<!--end::Action-->
							</form>
                    <!--end::Form-->  
     `

})

export default FormNewPassword