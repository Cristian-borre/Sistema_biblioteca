from django.urls import path,include
from rest_framework import routers
from app.usuario.views import UsuarioViewSet,UsuarioEmpleadoViewSet
from app.autor.views import AutorViewSet
from app.categoria.views import CategoriaViewSet
from app.editorial.views import EditorialViewSet
from app.encuadernado.views import EncuadernadoViewSet
from app.libro.views import LibroViewSet,LibroEmpleadoViewSet
from app.prestamo.views import PrestamoViewSet

app_name = 'api'
router = routers.DefaultRouter()

router.register('usuario', UsuarioViewSet, basename="usuario")
router.register('usuario-empleado', UsuarioEmpleadoViewSet, basename="usuario")
router.register('autor', AutorViewSet, basename="autor")
router.register('categoria', CategoriaViewSet, basename="categoria")
router.register('editorial', EditorialViewSet, basename="editorial")
router.register('encuadernado', EncuadernadoViewSet, basename="encuadernado")
router.register('libro', LibroViewSet, basename="libro")
router.register('libro-empleado', LibroEmpleadoViewSet, basename="libro")
router.register('prestamo', PrestamoViewSet, basename="prestamo")

urlpatterns = [ 
    path('', include(router.urls)),
]
urlpatterns += router.urls