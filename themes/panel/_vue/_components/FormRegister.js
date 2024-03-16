import {SYSTEM_URL, VIEWS_THEME, SITE_NAME, PASSWORD_LIMIT, API_URL} from './../CONFIG.js'
import LoadingButton from './LoadingButton.js'

const FormRegister = Vue.component('formregister', {

    // propriedades vindas do elemento pai
    props: [],

    // informações de retorno para o componente
    data: function () {

        return {
            userData: {
                firstName: "",
                lastName: "",
                email: "",
                password: "",
                confirmPassword: "",
                terms: "",
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

        this.$refs.firstName.focus();
    },

    // metodos
    methods: {
        resetForm() {
            this.userData.firstName = ''
            this.userData.lastName = ''
            this.userData.email = ''
            this.userData.password = ''
            this.userData.confirmPassword = ''
            this.userData.terms = ''
        },
        userRegister(event) {
            event.preventDefault();
            this.display = 'display: block'

            // checking validate

            if (this.userData.confirmPassword !== this.userData.password) {

                this.txtMessage = 'As senhas precisam ser idênticas'
                this.checkValidate = false;
                this.changeMessageClass();
                this.$refs.password.select();
                return
            }


            axios
                .post(`${API_URL()}/registerUser`, this.userData)
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
        LoadingButton: LoadingButton
    },

    // renderização
    template: `   

        <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" action="" ref="formRegister"
                          data-kt-redirect-url="../dist/authentication/sign-in/basic.html" id="kt_sign_up_form" v-on:submit="userRegister">
                        
                        <!--begin::Heading-->
                        <div class="mb-10 text-center">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Criar conta</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-semibold fs-4">Já tem uma conta?

                                <a href="${SYSTEM_URL()}/auth/login" class="link-primary fw-bold">Faça
                                    login</a></div>
                            <!--end::Link-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Separator-->
                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-semibold text-gray-400 fs-7 mx-2">OR</span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        </div>
                        <!--end::Separator-->
                        <!--begin::Input group-->
                        <div class="row fv-row mb-7">
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <label class="form-label fw-bold text-dark fs-6">Primeiro Nome</label>
                                <input v-model="userData.firstName" class="form-control form-control-lg form-control-solid" type="text"
                                       placeholder="Ex: Marcos"  autocomplete="off" ref="firstName" />
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <label class="form-label fw-bold text-dark fs-6">Sobrenome(s)</label>
                                <input ref="lastName" v-model="userData.lastName" class="form-control form-control-lg form-control-solid" type="text"
                                       placeholder="Ex. da Silva Medeiros" autocomplete="off"/>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bold text-dark fs-6">Email</label>
                            <input ref="email" v-model="userData.email" class="form-control form-control-lg form-control-solid" type="email" placeholder="Ex: marcos@email.com"
                                    autocomplete="off"/>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Label-->
                                <label class="form-label fw-bold text-dark fs-6">Senha</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input ref="password" v-model="userData.password" class="form-control form-control-lg form-control-solid" type="password"
                                           placeholder="********"  autocomplete="off"/>
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                          data-kt-password-meter-control="visibility">
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
                            <div class="text-muted">Sua senha deve conter entre ${PASSWORD_LIMIT()} e ${PASSWORD_LIMIT('max')} caracteres.
                            </div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-5">
                            <label class="form-label fw-bold text-dark fs-6">Confirme sua senha</label>
                            <input ref="confirmPassword" v-model="userData.confirmPassword" class="form-control form-control-lg form-control-solid" type="password"
                                   placeholder="********" autocomplete="off"/>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <label class="form-check form-check-custom form-check-solid form-check-inline">
                                <input ref="terms" v-model="userData.terms" class="form-check-input" type="checkbox" value="1" />
                                <span class="form-check-label fw-semibold text-gray-700 fs-6">Eu aceito
										<a href="#" class="ms-1 link-primary">os Termos e Condições de uso</a>.</span>
                            </label>
                        </div>
                        <!--end::Input group-->
                        <div id="loadResponse" :class="messageClass">{{txtMessage}}</div>
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label"><i class="fa fa-user"></i> Cadastrar</span>
								<LoadingButton :display="display" />
                            </button>
                        </div>
                        <!--end::Actions-->
                        
                    </form>
                    <!--end::Form-->  
     `

})

export default FormRegister