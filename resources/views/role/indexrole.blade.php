<div>
    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Role</h5>
              @can('add-role')
                   <button class="btn btn-secondary" wire:click="addrole">add role</button>

                   @if ($form == 'addrole')
                    <form wire:submit.prevent='storerole'>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">name role</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" wire:model='name'>
                        </div>
                        <div class="mb-3">
                            @foreach ($permissionss as $item)
                            <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $item->name }}"
                                        id="flexCheckDefault" wire:model='permissionselect.{{ $loop->index }}' name="permissionselect">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $item->name }}
                                    </label>
                            </div>    
                            @endforeach
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </form>
                @endif
              @endcan
               


                  
                

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>

                   @foreach ($role as $item)
                      <tr>
                        <td>
                            <p>{{ $item->name }}</p>
                        </td>
                            <td>
                                @can('edit-role')
                                    <button type="button" class="btn btn-secondary" wire:click="showedit('{{ $item->id }}')">edit</button>
                                @endcan
                                @can('delete-role')
                                    <button type="button" class="btn btn-danger" onclick="confirm('Are you sure you want to delete this role ?') || event.stopImmediatePropagation()" wire:click="deleterole('{{ $item->id }}')">delete</button>
                                @endcan
                            </td>
                        </tr>
                     @endforeach

                </tbody>
                {{ $role->links() }}
              </table>
              <!-- End Default Table Example -->
               @can('edit-role')
                  @if ($form == 'editrole')
                         <form wire:submit.prevent="updaterole('{{ $getidrole }}')">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">name role</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="getnamerole" wire:model='getnamerole'>
                             @error('getnamerole')
                            <div class="alert alert-danger" role="alert">
                            {{ $message }}
                            </div>
                             @enderror
                            
                        </div>
                         @foreach ($permissionss as $item)
                                <div class="form-check">
                                    <input wire:model='getpermissionrole' class="form-check-input" type="checkbox" value="{{ $item->name }}" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $item->name }}
                                    </label>
                                </div>
                          @endforeach
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" wire:click='resetall()'>cancel</button>
                    </form>
                @endif
              @endcan
                    @if ($form == 'detailrole')
                         <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">name role</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="namerole" wire:model='nameroles' readonly>
                        </div>        
                        <label for="" class="form-label">permission : </label>
                         @foreach ($permissionroles as $item)
                                <div class="form-check">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            @endforeach
                        <button type="button" class="btn btn-danger" wire:click='resetall()'>cancel</button>
                    </form>
                    @endif

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Permission</h5>
              @can('add-permission')
                   <button type="button" class="btn btn-primary my-2" wire:click="addpermission()">add permission</button>
               @if ($form == 'addpermission')
                    <form class="my-2" wire:submit.prevent='storepermission'>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">name permission</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="namepermission" wire:model='namepermission'>
                             @error('namepermission')
                            <div class="alert alert-danger" role="alert">
                            {{ $message }}
                            </div>
                             @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">submit</button>
                        <button type="button" class="btn btn-danger" wire:click='resetall()'>cancel</button>
                    </form>
                @endif
              @endcan
               
              @can('edit-permission')
                   @if ($form == 'editpermission')
                    <form class="mb-3" wire:submit.prevent='updatepermission({{ $idpermission }})'>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">name permission</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="namepermission" wire:model='namepermission'>
                             @error('namepermission')
                            <div class="alert alert-danger" role="alert">
                            {{ $message }}
                            </div>
                             @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">submit</button>
                        <button type="button" class="btn btn-danger" wire:click='resetall()'>cancel</button>
                    </form>
                @endif
              @endcan
              


              <!-- Table with stripped rows -->
               <table class="table my-2">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($permissions as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @can('edit-permission')
                                            <button type="button" class="btn btn-secondary" wire:click="editpermission('{{ $item->id }}')">edit</button>
                                        @endcan
                                        @can('delete-permission')
                                            <button type="button" class="btn btn-danger" onclick="confirm('Are you sure you want to delete this permission ?') || event.stopImmediatePropagation()" wire:click="deletepermission('{{ $item->id }}')">delete</button>
                                        @endcan
                                        
                                    </td>
                                </tr>
                            @endforeach
                </tbody>
                {{ $permissions->links() }}
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
</div>

{{-- <div>
    <div class="container-sm p-3 bg-white mt-10">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" wire:click="addrole">add role</button>
                @if ($form == 'addrole')
                    <form wire:submit.prevent='storerole'>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">name role</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" wire:model='name'>
                        </div>
                        <div class="mb-3">
                            @foreach ($permissionss as $item)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $item->name }}"
                                        id="flexCheckDefault" wire:model='permissionselect.{{ $loop->index }}' name="permissionselect[]">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </form>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>name</th>
                            <th>action</th>
                        </thead>
                        <tbody>
                            @foreach ($role as $item)
                                <tr>
                                    <td><button wire:click="detailrole('{{ $item->id }}')">{{ $item->name }}</button></td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" wire:click="showedit('{{ $item->id }}')">edit</button>
                                        <button type="button" class="btn btn-danger"
                                            wire:click="deleterole('{{ $item->id }}')">delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{ $role->links() }}
                    </table>
                    @if ($form == 'editrole')
                         <form wire:submit.prevent="updaterole('{{ $idrole }}')">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">name role</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="namerole" wire:model='namerole'>
                             @error('namerole')
                            <div class="alert alert-danger" role="alert">
                            {{ $message }}
                            </div>
                             @enderror
                            
                        </div>        
                         @foreach ($permissionss as $item)
                                <div class="form-check">
                                    <input wire:model='permissionupdate' checked='checked' class="form-check-input" type="checkbox" value="{{ $item->name }}" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            @endforeach
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" wire:click='resetall()'>cancel</button>
                    </form>
                    @endif

                    @if ($form == 'detailrole')
                         <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">name role</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="namerole" wire:model='nameroles' readonly>
                        </div>        
                        <label for="" class="form-label">permission : </label>
                         @foreach ($permissionroles as $item)
                                <div class="form-check">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            @endforeach
                        <button type="button" class="btn btn-danger" wire:click='resetall()'>cancel</button>
                    </form>
                    @endif
                </div>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary" wire:click="addpermission()">add permission</button>
                @if ($form == 'addpermission')
                    <form wire:submit.prevent='storepermission'>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">name permission</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="namepermission" wire:model='namepermission'>
                             @error('namepermission')
                            <div class="alert alert-danger" role="alert">
                            {{ $message }}
                            </div>
                             @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">submit</button>
                        <button type="button" class="btn btn-danger" wire:click='resetall()'>cancel</button>
                    </form>
                @endif
                @if ($form == 'editpermission')
                    <form wire:submit.prevent='updatepermission({{ $idpermission }})'>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">name permission</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="namepermission" wire:model='namepermission'>
                             @error('namepermission')
                            <div class="alert alert-danger" role="alert">
                            {{ $message }}
                            </div>
                             @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">submit</button>
                        <button type="button" class="btn btn-danger" wire:click='resetall()'>cancel</button>
                    </form>
                @endif
                 <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>name</th>
                            <th>action</th>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" wire:click="editpermission('{{ $item->id }}')">edit</button>
                                        <button type="button" class="btn btn-danger" wire:click="deletepermission('{{ $item->id }}')">delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{ $permissions->links() }}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}
