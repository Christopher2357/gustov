<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../images/gustov.jpg" alt="User Image">
  <div>
    <p class="app-sidebar__user-name">Restaurant</p>
    <p class="app-sidebar__user-designation">Gustov</p>
  </div>
</div>

<ul class="app-menu">
  <style>
    .app-menu__item:hover .app-menu__icon,
    .app-menu__label,
    .treeview-indicator {
      color: white;
      cursor: pointer;
    }
  </style>
  <li>
    <a class="app-menu__item active"
      onclick="cargar_contenido('Contenido_principal','../view/personal/view_listar_personal.php');toggleActiveClass(this)">
      <i class="app-menu__icon fa fa-user"></i>
      <span class="app-menu__label">Personal</span>
      <i class="treeview-indicator fa fa-angle-right"></i>
    </a>
  </li>
  <li>
    <a class="app-menu__item "
      onclick="cargar_contenido('Contenido_principal','../view/vacaciones/view_lista_personas.php');toggleActiveClass(this)">
      <i class="app-menu__icon fa fa-calendar"></i>
      <span class="app-menu__label">Vacaciones</span>
      <i class="treeview-indicator fa fa-angle-right"></i>
    </a>
  </li>
  
  <li>
    <a class="app-menu__item "
      onclick="cargar_contenido('Contenido_principal','../view/reporte/view_report_vacaciones.php');toggleActiveClass(this)">
      <i class="app-menu__icon fa fa-file-text"></i>
      <span class="app-menu__label">Reportes</span>
      <i class="treeview-indicator fa fa-angle-right"></i>
    </a>
  </li>

</ul>