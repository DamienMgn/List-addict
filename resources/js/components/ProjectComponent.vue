<template>
  <div>
      <ContentComponent
          :title="categories[paramsId].name"
          :color="categories[paramsId].color"
          @delete="deleteCategory"
          :category="paramsId"
      >
      </ContentComponent>
      <div class="project-container">
          <div class="" v-for="card in categories[this.$route.params.id].cards">
              <CardComponent v-bind:card="card"></CardComponent>
          </div>
      </div>
      <ModalCard @add="addCard" :category="paramsId"></ModalCard>
  </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import CardComponent from './CardComponent.vue'
    import ContentComponent from './partials/ContentComponent'
    import ModalCard from "./partials/ModalCard";

    export default {
        components: {
            CardComponent,
            ContentComponent,
            ModalCard
        },
        data() {
            return {
                cardName: '',
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
            }
        },
        watch: {
            $route(to, from) {
                this.$store.dispatch('loadCards', this.$route.params.id)
            }
        },
        methods: {
            addCard: function(value) {
                this.$store.dispatch('insertCard', {
                    cardName: value.cardName,
                    categoryId: value.categoryId,
                    cardColor: value.cardColor
                    })
            },
            deleteCategory: function (value) {
                this.$store.dispatch('deleteCategory', value.categoryId)
                this.$router.push({name: 'home'})
            },
        }
    }
</script>
