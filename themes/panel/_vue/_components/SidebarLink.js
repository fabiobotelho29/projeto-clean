const SidebarLink = Vue.component('SidebarLink', {

    // propriedades vindas do elemento pai
    props: ["content"],

    // informações de retorno para o componente
    data: function () {

        return {}
    },

    // componentes
    components: {},

    // renderização
    template: `   

        <!--begin:Menu item-->
		<div class="menu-item">
			<!--begin:Menu link-->
			<a class="menu-link" :href="content.href">
				<span class="menu-bullet">
					<span class="bullet bullet-dot"></span>
				</span>
				<span class="menu-title">{{ content.text }}</span>
			</a>
			<!--end:Menu link-->
		</div>
		<!--end:Menu item-->    
     `

})

export default SidebarLink