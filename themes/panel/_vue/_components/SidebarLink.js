const SidebarLink = Vue.component('SidebarLink', {

    // propriedades vindas do elemento pai
    props: ["link", "text"],

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
			<a class="menu-link" :href="link">
				<span class="menu-bullet">
					<span class="bullet bullet-dot"></span>
				</span>
				<span class="menu-title" style="font-weight: bold; font-size: 1.2em; color: #92929F">{{ text }}</span>
			</a>
			<!--end:Menu link-->
		</div>
		<!--end:Menu item-->    
     `

})

export default SidebarLink