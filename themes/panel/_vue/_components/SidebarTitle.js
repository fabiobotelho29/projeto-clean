

const SidebarTitle = Vue.component('SidebarTitle', {

    // propriedades vindas do elemento pai
    props: ["content"],

    // informações de retorno para o componente
    data: function () {

        return {}
    },

    // componentes
    components: {

    },

    // renderização
    template: `   

        <!--begin:Menu link-->
        <span class="menu-link">
			<span class="menu-icon">
				<i :class="content.icon">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
					<span class="path4"></span>
				</i>
			</span>
			<span class="menu-title">{{ content.text }}</span>
			<span class="menu-arrow"></span>
		</span>
        <!--end:Menu link-->
    
     `

})

export default SidebarTitle