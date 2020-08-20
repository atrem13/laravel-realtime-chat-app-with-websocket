<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(menu, i) in menus" :key="i">
                                    <td>{{menu.nama}}</td>
                                    <td>{{menu.deskripsi}}</td>
                                    <td>{{menu.harga}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'index-menu',
    created(){
        this.fetchMenu();
        Echo.join('NewMenu')
                .listen('NewMenuAdded', (event) => {
                    // console.log(event);
                    this.menus.push(event.menu);
                });
    },
    data(){
        return{
            menus: [],
            // newMenu: {
            //     nama: '',
            //     deskripsi: '',
            //     harga: ''
            // }
        }
    },
    methods:{
        fetchMenu(){
            axios.get('/data/menu').then(response => {
                // console.log(response);
                this.menus = response.data;
            });
        },
        // addMenu(){
        //     axios.post('/menu').then(response => {
        //         console.log(response);
        //     });
        // }
    }
}
</script>
