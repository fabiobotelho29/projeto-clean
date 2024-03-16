import {SYSTEM_URL, API_URL} from './../CONFIG.js'
import LoadingButton from "./LoadingButton.js";

const FormResetPassword = Vue.component('formresetpassword', {

    // propriedades vindas do elemento pai
    props: [],

    // informações de retorno para o componente
    data: function () {

        return {
            userData: {
                email: "",
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

        this.$refs.email.focus();
    },

    // metodos
    methods: {
        resetForm() {
            this.userData.email = ''
        },

        passwordReset(event) {
            event.preventDefault();
            this.display = 'display: block'

            if (this.userData.email === '') {
                this.txtMessage = 'Preencha o campo Email'
                this.checkValidate = false;
                this.changeMessageClass();
                this.display = 'display: none'
                return
            }

            axios
                .post(`${API_URL()}/passwordReset`, this.userData)
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
                        this.redirectURL(data.url)
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
        },
        redirectURL: function (url) {
            window.location = url
        }
    },

    // componentes
    components: {
        LoadingButton: LoadingButton,
    },

    // renderização
    template: `   

        <!--begin::Form-->
                    <form v-on:submit="passwordReset" ref="formResetPassword" class="form w-100" novalidate="novalidate" data-kt-redirect-url="../dist/authentication/sign-in/new-password.html" id="kt_password_reset_form">
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">Esqueceu a senha ?</h1>
									<!--end::Title-->
									<!--begin::Link-->
									<div class="text-gray-400 fw-semibold fs-4">Digite seu e-mail para recuperar sua senha.</div>
									<!--end::Link-->
								</div>
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<label class="form-label fw-bold text-gray-900 fs-6">Email</label>
									<input ref="email" v-model="userData.email" class="form-control form-control-lg form-control-solid" type="email" placeholder="Ex: marcos@email.com"
                                    autocomplete="off"/>
								</div>
								<!--end::Input group-->
								<div id="loadResponse" :class="messageClass">{{txtMessage}}</div>
								<!--begin::Actions-->
								<div class="d-flex flex-wrap justify-content-center pb-lg-0">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label"><i class="fa fa-lock"></i> Recuperar Senha</span>
                                <LoadingButton :display="display" />
                            </button>
								</div>
								<!--end::Actions-->
							</form>
                    <!--end::Form-->  
     `

})

export default FormResetPassword