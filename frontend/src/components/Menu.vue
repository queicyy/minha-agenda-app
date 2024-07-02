<script setup>
import Heeader_ from '../components/Header_.vue'
</script>
<template>
    <!-- ======= Header ======= -->
    <Heeader_ />
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <router-link class="nav-link " to="/">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </router-link>
            
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Agendamento</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    
                      
                    <li>
                        <router-link class="nav-link " to="/profissional">
                           
                            <i class="bi bi-circle"></i><span>Profissional</span>
                        </router-link>
                       
                    </li>
                    <li>
                        <router-link class="nav-link " to="/servico">
                           
                            <i class="bi bi-circle"></i><span>Serviços</span>
                        </router-link>
                        
                    </li>

                </ul>
            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Clientes</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <router-link class="nav-link " to="/add_cliente">
                           
                            <i class="bi bi-circle"></i><span>Cadastrar</span>
                        </router-link>
                        
                    </li>
                    <li>
                        <router-link class="nav-link " to="/cliente">
                            
                            <i class="bi bi-circle"></i><span>Cliente</span>
                        </router-link>
                        
                    </li>
                    <li>
                        <router-link class="nav-link " to="/status-cliente">
                           
                            <i class="bi bi-circle"></i><span>Status</span>
                        </router-link>
                       
                    </li>

                </ul>
            </li><!-- End Forms Nav -->



            <li class="nav-heading">Configuração</li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Perfil</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="forms-elements.html">
                            <i class="bi bi-circle"></i><span>Registrar Novo Perfil</span>
                        </a>
                    </li>
                    <li>
                        <a href="forms-layouts.html">
                            <i class="bi bi-circle"></i><span>Logins</span>
                        </a>
                    </li>


                </ul>
            </li><!-- End Forms Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#relatorio-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Relatório</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="relatorio-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="forms-elements.html">
                            <i class="bi bi-circle"></i><span>Relatorio Clientes</span>
                        </a>
                    </li>
                    <li>
                        <a href="forms-layouts.html">
                            <i class="bi bi-circle"></i><span>Relatorio Profissional</span>
                        </a>
                    </li>
                    <li>
                        <a href="forms-layouts.html">
                            <i class="bi bi-circle"></i><span>Relatorio Serviços</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-heading">Painel do administrador</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="users-profile.html">
                    <i class="bi bi-person"></i>
                    <span>Permissões</span>
                </a>

            </li><!-- End Profile Page Nav -->



        </ul>

    </aside><!-- End Sidebar-->
</template>