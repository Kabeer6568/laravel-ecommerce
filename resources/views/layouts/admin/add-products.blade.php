@extends('layouts.app')


@section('content')

<div class="breadcrumb-wrap">
            <div class="container">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">Add Products</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        
        <!-- Login Start -->
        <div class="login">
            <div class="container">
                <div class="section-header">
                    <h3>Add Product</h3>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.addProduct') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="login-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Product Name</label>
                                    <input class="form-control" name="name" type="text" placeholder="Product Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Product Slug</label>
                                    <input class="form-control" name="slug" type="text" placeholder="Product Slug" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Product Price</label>
                                    <input class="form-control" name="price" type="text" placeholder="Product Price" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Product Description</label>
                                    <input class="form-control" name="description" type="text" placeholder="Product description" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Product Image</label>
                                    <input class="form-control" name="image" type="file" accept="image/*" required >
                                </div>
                                <div class="col-md-6">
                                    <label style="display: block; margin-bottom: 8px;">Make Featured</label>
                                    <div style="display: flex; gap: 20px; align-items: center;">
                                        <label style="display: flex; align-items: center; gap: 5px; cursor: pointer; margin: 0;">
                                            <input type="radio" name="is_featured" value="1" required style="margin: 0; cursor: pointer;">
                                            <span>Yes</span>
                                        </label>
                                        <label style="display: flex; align-items: center; gap: 5px; cursor: pointer; margin: 0;">
                                            <input type="radio" name="is_featured" value="0" required style="margin: 0; cursor: pointer;">
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <button class="btn" type="submit" >Submit</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <!-- Login End -->
          @endsection