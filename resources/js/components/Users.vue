<template>
    <div class="content">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title" id="addnewmodal">User List</h4>
                                   

                                    <button type="submit" class="btn btn-success" @click="showModal">Add New </button>
                                    
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                             <th>Role</th>
                                             <th>Bio</th>
                                             <th>Created Time</th>

                                            <th>Modify</th>
                                        </thead>

                                        <tbody>
                                           <tr v-for="user in users" :key="user.id">
                                            <td>{{user.id}}</td>
                                                <td>{{user.name}}</td>
                                                <td>{{user.email}}</td>
                                                <td>{{user.type|Uppercase}}</td>
                                                <td>{{user.bio}}</td>
                                                <td>{{user.created_at | DateFormat}}</td>

                                                <td>
                                                    <a href="#"  @click="editModal(user)" >
                                                    <i class="fa fa-edit blue"></i>
                                                    </a>
                                                    /
                                                    <a href="#" @click="deleteuser(user.id)">
                                                    <i class="fa fa-trash red"></i>
                                                    </a>
                                                   
                                                </td>
                                            </tr>

                                            
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                 <!-- Modal -->
                <div class="modal" id="AddUserModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                             <h5 class="modal-title"  v-show="!editmode" >User create Form</h5>
                               <h5 class="modal-title"  v-show="editmode" >Edit  User Form</h5>
                            

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent=" editmode ? updateuser() :adduser()">
                                   <div class="form-group">
                                        <input v-model="form.name" type="text" name="name"
                                       placeholder="name" class="form-control" :class="{'is-valid':form.errors.has('name')}">
                                         <has-error :form="form" field="name"></has-error>
                                    </div>                                   

                                    <div class="form-group">
                                        <label for="recipient-name" class="form-control-label" >Bio:</label>

                            <textarea v-model="form.bio" type="text" name="bio"
                                      placeholder="Shor Bio for user (Optional)" class="form-control" :class="{'is-valid':form.errors.has('bio')}">
                            </textarea>
                                <has-error :form="form" field="bio"></has-error>
                                
                            
                               
                            </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="form-control-label" >Email:</label>
                                        <input v-model="form.email" type="text" name="email"
                                       placeholder="Email Address" class="form-control" :class="{'is-valid':form.errors.has('email')}">
                                     <has-error :form="form" field="email"></has-error>
                                
                                    </div>
                                   <div class="form-group">
                                        <label for="recipient-name" class="form-control-label" >Role:</label>

                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{
                            'is-valid':form.errors.has('type')}">
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <option value="author">Author</option>
                                </select>
                            </div>

                                    <div class="form-group">
                                        <label for="" class="form-control-label" >Password:</label>
                                        <div class="form-group">
                                 <input v-model="form.password" type="password" name="password"
                                       placeholder="Enter Password" class="form-control" :class="{'is-valid':form.errors.has('password')}">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                                    </div>
                            <div class="modal-footer">
                               
                                 
                                  <button type="submit" v-show="!editmode" class="btn btn-primary">Add user</button> 
                                   <button type="submit"  v-show="editmode" class="btn btn-primary">Update user</button> 

                            </div>
                                </form>
                                   
                               
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!--End Modal -->
                    
               
            </div>                
    </div>
            
</template>

<script>
  export default {
      mounted(){
            console.log("user mounted")
        },
    data(){
      return{
         editmode:false,
           users:{}, 
        form: new Form( {
          
           id:'',
          name: '',
          email:'',
          password: '',
         bio: '',
         type:'',
         photo:''
        })   
        
      }
    },
      created() {
            //console.log("This is user page.");
            this.loaduser();
             
      },
      methods:{
           deleteuser(id){
                     swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        this.form.delete('api/users/'+id).then(()=>{
                            Fire.$emit('AfterCreated');
                            swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }).catch(()=> {
                            swal.fire("Failed!", "There was something wronge.", "warning");
                        });
                    }
                })
                    },
           updateuser(id){
                 this.$Progress.start();
               // console.log("editiing data");
               this.form.put('api/users/'+this.form.id)
               .then(()=>{
                   $('#AddUserModal').modal('hide');
                    swal.fire(
                                'updated!',
                                'Your file has been updated.',
                                'success'
                    )
                     this.$Progress.finish();
                      Fire.$emit('AfterCreated');
               })
               .catch(()=>{
                    this.$Progress.fail();
               });
            },
          editModal(user){
               this.editmode= true;
               this.form.reset();
           
            $('#AddUserModal').modal('show');
            this.form.fill(user);
          },

          loaduser(){
              axios.get('api/users').then(({data}) => (this.users = data));

          },
         
         
          loaduser(){
              axios.get('api/users').then(({data}) => (this.users = data));

          },

       showModal(){
           // this.editmode = false;
            this.form.reset();
            $('#AddUserModal').modal('show');
       },
       
       adduser(){
               this.$Progress.start();

                this.form.post('api/users')
                    .then(()=>{
                        
                       
                        $('#AddUserModal').modal('hide');
                         Toast.fire({
                            type: 'success',
                            title: 'User Created successfully'
                        })                   
                        this.$Progress.finish();
                          Fire.$emit('AfterCreated');
                    })
                     .catch(()=>{
                             this.$Progress.fail();
                    });
       }
      }

       
  }
</script>