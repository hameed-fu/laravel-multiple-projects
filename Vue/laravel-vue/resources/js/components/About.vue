<template>
    <div>
        <h2>About</h2>
        <div class="form-group">
          <label for="country"></label>
        <select v-model="country" name="country" class="form-control" @change="getRegion">
            <option>Select country</option>
            <option  v-for="country in countries" :value="country.id" :key="country.id">{{ country.name }}</option>
        </select>
        </div>
        <div class="form-group">
        <label for="region">region</label>
        <select v-model="region" name="region" class="form-control">
            <option v-for="region in regions" :value="region.id" :key="region.id">{{ region.name }}</option>
              </select>
        </div>
        
    </div>
</template>

<script>
import axios from 'axios'
import Vue from 'vue'
Vue.use(axios)
    export default {
        data() {
        return {
            countries: [],
            regions: [],
            country: '',
            region: '',
            }
     },

        mounted() {
                this.loadCountries()
                
                },

        methods: {
            loadCountries() {
            axios.get('/api/countries')
            .then(response => {
                console.log(response.data)
                this.countries = response.data
            }).catch(err =>{
                console.log(err)
            })
        },  
        getRegion(){
            axios.get('api/regions/'+this.id)
                .then(response=>{
                    console.log(response)
                }).catch(err=>{
                    console.log(err)
                })
        },
            loadRegions(country_id) {
                axios.get('api/regionsd/'+country_id)
                .then(response=>{
                    console.log(response)
                }).catch(err=>{
                    console.log(err)
                })
        }
     }
    }
</script>

<style lang="scss" scoped>

</style>