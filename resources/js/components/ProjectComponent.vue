<template>
  <div v-if="categories[paramsId] !== undefined">
      <ContentComponent
          :title="categories[paramsId].name"
          :color="categories[paramsId].color"
          @delete="deleteCategory"
          :category="paramsId"
      >
      </ContentComponent>
      <draggable
          :list="newCardsOrder"
          class="project-container"
          :animation="500"
          :group="'share'"
          :tag="'ul'"
          @change="updateCardsOrder">
          <li v-for="card in Object.values(categories[this.paramsId].cards).sort((a, b) => {return a.order - b.order})">
              <CardComponent v-bind:card="card"></CardComponent>
          </li>
      </draggable>
      <Modal
          :type="'card'"
          :id="'modal-add-card'"
          :title="'Ajouter une carte'"
          @add="addCard"
          :category="paramsId">
      </Modal>
  </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import CardComponent from './CardComponent.vue';
    import ContentComponent from './partials/ContentComponent';
    import Modal from "./partials/Modal";
    import draggable from 'vuedraggable';


    export default {
        name: "ProjectComponent",
        components: {
            CardComponent,
            ContentComponent,
            Modal,
            draggable
        },
        data() {
            return {
                cardName: '',
                newCardsOrder: this.categories
            }
        },
        mounted () {
            this.$store.dispatch('loadCards', this.$route.params.id)
        },
        computed: {
            ...mapGetters(['categories']),
            ...mapGetters(['errors']),
            paramsId: function () {
                return this.$route.params.id
            },
        },
        watch: {
            $route(to, from) {
                this.$store.dispatch('loadCards', this.$route.params.id)
            },
            categories: function (newVal) {
                this.newCardsOrder = Object.values(newVal[this.$route.params.id].cards)
            }
        },
        methods: {
            addCard: function(value) {
                this.$store.dispatch('insertCard', {
                    cardName: value.cardName,
                    categoryId: value.categoryId,
                    cardColor: value.cardColor
                    })
                $('#modal-add-card').find("input[type=text]").val('');
            },
            deleteCategory: function (value) {
                this.$store.dispatch('deleteCategory', value.categoryId)
                this.$router.push({name: 'home'})
            },
            updateCardsOrder: function () {
                this.$store.dispatch('updateCardsOrder', {newCardsOrder: this.newCardsOrder, categoryId: this.paramsId})
            },
        }
    }
</script>
