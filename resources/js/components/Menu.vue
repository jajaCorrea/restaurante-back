<template>
  <v-container class="stlAll">
    <v-flex>
      <v-flex class="text-center display-1">Menú</v-flex>
      <hr
        style="border-color:orange; width:90px; margin-left:auto; margin-right:auto; border-bottom-width:3px;"
      />
      <v-container>
        <v-row>
          <v-col class="text-center" cols="12" sm="4" md="3" lg="2">
            <v-card>
              <v-card-text>
                <span class="title">Mesa 1</span>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col class="text-center" cols="12" sm="4" md="3" lg="2">
            <v-card>
              <v-card-text>
                <span class="title">Mesa 2</span>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col class="text-center" cols="12" sm="4" md="3" lg="2">
            <v-card>
              <v-card-text>
                <span class="title">Mesa 3</span>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col class="text-center" cols="12" sm="4" md="3" lg="2">
            <v-card>
              <v-card-text>
                <span class="title">Mesa 4</span>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col class="text-center" cols="12" sm="4" md="3" lg="2">
            <v-card>
              <v-card-text>
                <span class="title">Mesa 5</span>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col class="text-center" cols="12" sm="4" md="3" lg="2">
            <v-card>
              <v-card-text>
                <span class="title">Mesa 6</span>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
      <div v-for="tipos in menu" :key="tipos.id">
        <p class="display-1">{{tipos.nombre}}</p>
        <hr style="margin-left: 1%; margin-right: 1%;" />
        <br />
        <v-container class="row">
          <div v-for="comida in tipos.info_platillo" :key="comida.id" class="pa-2">
            <v-card max-width="350px" height="300px" @click="agregar(comida.nombre,comida.precio)">
              <v-img
                class="white--text align-end"
                height="200px"
                :src="comida.URL"
                :alt="comida.alt"
              >
                <v-card-title class="stlName">{{comida.nombre}}</v-card-title>
              </v-img>
              <v-card-subtitle class="headline">${{comida.precio}}</v-card-subtitle>
              <v-card-text>{{comida.tipo}}</v-card-text>
            </v-card>
          </div>
        </v-container>
      </div>
    </v-flex>
    <div>
      <c-agregar :titulo="nombre" :precio="precio" :dialog="modal_agregar"></c-agregar>
    </div>
  </v-container>
</template>
<script>
import axios from "axios";
import agregar from "./agregar";
export default {
  name: "menu",
  data() {
    return {
      menu: [],
      modal_agregar: false,
      nombre: "",
      precio: 0
    };
  },
  components: {
    "c-agregar": agregar
  },
  methods: {
    agregar(nombre, precio) {
      this.modal_agregar = true;
      this.nombre = nombre;
      this.precio = precio;
    },
    getPlatillos: function() {
      axios
        .get("/api/platillos")
        .then(response => {
          this.menu = response.data;
        })
        .catch(function(error) {
          console.log("Error: " + error);
        });
    }
  },
  created() {
    this.getPlatillos();
  }
};
</script>
<style scoped>
.stlName {
  font-size: 28px;
  text-shadow: 1px 1px 0px #000000;
}
</style>