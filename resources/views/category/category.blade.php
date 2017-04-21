@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <vue-router></vue-router>
            </div>
        </div>
    </div>
    <script>
        import HeaderComponent from './components/categories.vue'
        import OtherComponent from './components/home.vue'
        export default{
            data(){
                return{
                    msg:'hello vue'
                }
            },
            components:{
                OtherComponent,
                HeaderComponent,
            }
        }
        var demo = new Vue({
            el: '#app',
            data: {
                gridColumns: ['customerId', 'companyName', 'contactName', 'phone'],
                apiUrl: 'http://localhost:8000/users/1/category'
            },
            created: function() {
                this.getCustomers()
            },
            methods: {
                getCustomers: function() {
                    this.$http.get(this.apiUrl)
                            .then((response) => {
                               this.gridData=response.body;

                            })
                }
            }
        })
    </script>
@endsection
