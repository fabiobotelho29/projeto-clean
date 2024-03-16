import {SYSTEM_URL, API_URL} from './../CONFIG.js'
import LoadingButton from "./LoadingButton.js";

const FormRegister = Vue.component('formlogin', {

    // propriedades vindas do elemento pai
    props: [],

    // informações de retorno para o componente
    data: function () {

        return {
            userData: {
                email: "",
                password: "",
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
            this.userData.password = ''
        },
        userLogin(event) {
            event.preventDefault();
            this.display = 'display: block'

            if (this.userData.email === '') {
                this.txtMessage = 'Preencha o campo Email'
                this.checkValidate = false;
                this.changeMessageClass();
                this.display = 'display: none'
                return
            }

            if (this.userData.password === '') {
                this.txtMessage = 'Preencha o campo Senha'
                this.checkValidate = false;
                this.changeMessageClass();
                this.display = 'display: none'
                return
            }

            axios
                .post(`${API_URL()}/loginUser`, this.userData)
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
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" ref="formLogin"
                          data-kt-redirect-url="../dist/index.html" action="" v-on:submit="userLogin">
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Login</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-semibold fs-4">Novo por aqui?
                                <a href="${SYSTEM_URL()}/auth/register" class="link-primary fw-bold">Crie sua Conta</a></div>
                            <!--end::Link-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bold text-dark">Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input ref="email" v-model="userData.email" class="form-control form-control-lg form-control-solid" type="email" placeholder="Ex: marcos@email.com"
                                    autocomplete="off"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bold text-dark fs-6 mb-0">Senha</label>
                                <!--end::Label-->
                                <!--begin::Link-->
                                <a href="../dist/authentication/sign-in/password-reset.html"
                                   class="link-primary fs-6 fw-bold">Esqueceu a senha ?</a>
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Input-->
                            <input ref="password" v-model="userData.password" class="form-control form-control-lg form-control-solid" type="password"
                                           placeholder="********"  autocomplete="off"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <div id="loadResponse" :class="messageClass">{{txtMessage}}</div>
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label"><i class="fa fa-sign-in"></i> Entrar</span>
                                <LoadingButton :display="display" />
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->  
     `

})

export default FormRegister