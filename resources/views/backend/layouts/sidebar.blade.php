@php
    $settings=DB::table('settings')->get();
@endphp
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
        <img src="@foreach ($settings as $data) {{asset('assets/images/setting/'.$data->logo)}} @endforeach" alt="">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">@foreach ($settings as $data) {{$data->company_name}} @endforeach</div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Page section
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('file-manager')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Media Manager</span></a>
    </li> --}}

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-image"></i>
            <span>Carousel</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options Carousels:</h6>
                <a class="collapse-item" href="{{ route('banner.index') }}">Carousel</a>
                <a class="collapse-item" href="{{ route('banner.create') }}">Ajouter Carousel</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFeature"
            aria-expanded="true" aria-controls="collapseFeature">
            <i class="fas fa-image"></i>
            <span> Fonctionnalités</span>
        </a>
        <div id="collapseFeature" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options Fonctionnalités:</h6>
                <a class="collapse-item" href="{{ route('feature.index') }}">Fonctionnalités</a>
                <a class="collapse-item" href="{{ route('feature.create') }}">Ajouter Fonctionnalité</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTestimonial"
            aria-expanded="true" aria-controls="collapseTestimonial">
            <i class="fas fa-users"></i>
            <span> Témoignages</span>
        </a>
        <div id="collapseTestimonial" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options Témoignages:</h6>
                <a class="collapse-item" href="{{ route('testimonial.index') }}">Témoignages</a>
                <a class="collapse-item" href="{{ route('testimonial.create') }}">Ajouter Témoignage</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Shop
    </div>

    <!-- Categories -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryCollapse"
            aria-expanded="true" aria-controls="categoryCollapse">
            <i class="fas fa-sitemap"></i>
            <span>Catégories</span>
        </a>
        <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options Catégories:</h6>
                <a class="collapse-item" href="{{ route('category.index') }}">Catégories</a>
                <a class="collapse-item" href="{{ route('category.create') }}">Ajouter Catégorie</a>
            </div>
        </div>
    </li>
    {{-- Products --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse"
            aria-expanded="true" aria-controls="productCollapse">
            <i class="fas fa-cubes"></i>
            <span>Produits</span>
        </a>
        <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options Produits:</h6>
                <a class="collapse-item" href="{{ route('product.index') }}">Produits</a>
                <a class="collapse-item" href="{{ route('product.create') }}">Ajouter Produit</a>
            </div>
        </div>
    </li>

    {{-- Brands --}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brandCollapse"
            aria-expanded="true" aria-controls="brandCollapse">
            <i class="fas fa-table"></i>
            <span>Brands</span>
        </a>
        <div id="brandCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Brand Options:</h6>
                <a class="collapse-item" href="{{ route('brand.index') }}">Brands</a>
                <a class="collapse-item" href="{{ route('brand.create') }}">Add Brand</a>
            </div>
        </div>
    </li> --}}

    {{-- Shipping --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shippingCollapse"
            aria-expanded="true" aria-controls="shippingCollapse">
            <i class="fas fa-truck"></i>
            <span>Livraison</span>
        </a>
        <div id="shippingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options livraison:</h6>
                <a class="collapse-item" href="{{ route('shipping.index') }}">Livraison</a>
                <a class="collapse-item" href="{{ route('shipping.create') }}">Ajouter livraison</a>
            </div>
        </div>
    </li>

    <!--Orders -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('order.index') }}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>Commandes</span>
        </a>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('review.index') }}">
            <i class="fas fa-comments"></i>
            <span>Avis</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Postes
    </div>

    <!-- Posts -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse"
            aria-expanded="true" aria-controls="postCollapse">
            <i class="fas fa-fw fa-folder"></i>
            <span>Postes</span>
        </a>
        <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options Postes:</h6>
                <a class="collapse-item" href="{{ route('post.index') }}">Postes</a>
                <a class="collapse-item" href="{{ route('post.create') }}">Ajouter Poste</a>
            </div>
        </div>
    </li>

    <!-- Category -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCategoryCollapse"
            aria-expanded="true" aria-controls="postCategoryCollapse">
            <i class="fas fa-sitemap fa-folder"></i>
            <span>Categories</span>
        </a>
        <div id="postCategoryCollapse" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options Categories:</h6>
                <a class="collapse-item" href="{{ route('post-category.index') }}">Categories</a>
                <a class="collapse-item" href="{{ route('post-category.create') }}">Ajouter Categorie</a>
            </div>
        </div>
    </li>

    <!-- Tags -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tagCollapse"
            aria-expanded="true" aria-controls="tagCollapse">
            <i class="fas fa-tags fa-folder"></i>
            <span>Tags</span>
        </a>
        <div id="tagCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Options Tag:</h6>
                <a class="collapse-item" href="{{ route('post-tag.index') }}">Tags</a>
                <a class="collapse-item" href="{{ route('post-tag.create') }}">Ajouter Tag</a>
            </div>
        </div>
    </li>

    <!-- Comments -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('comment.index') }}">
            <i class="fas fa-comments fa-chart-area"></i>
            <span>Commentaires</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        Paramètres Générals
    </div>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('coupon.index') }}">
            <i class="fas fa-table"></i>
            <span>Coupon</span></a>
    </li> --}}
    <!-- Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span>Utilisateurs</span></a>
    </li>
    <!-- General settings -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('settings') }}">
            <i class="fas fa-cog"></i>
            <span>Paramètres</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
