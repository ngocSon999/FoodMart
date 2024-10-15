<template>
    <div class="" style="margin-top: 20px">
        <button style="width: 150px; float: left; margin-bottom: 10px" @click="showCreateProduct = !showCreateProduct">Tạo mới sản phẩm</button>
        <div v-if="showCreateProduct" class="create-product">
            <form @submit.prevent="addTrademark" id="create-trademark" enctype="multipart/form-data">
                <div class="form-group d-flex">
                    <label for="">Chọn thương hiệu</label>
                    <select
                        class="form-control" v-model="trademarkId" name="parent_id" id="parent_id"
                        style="min-width: 140px; border: 1px solid; height: 42px; margin: 0 12px; border-radius: 6px"
                        @change="selectCategory"
                    >
                        <option value="">Chọn thương hiệu</option>
                        <option v-for="trademark in trademarks" :value="trademark.id">{{ trademark.name }}</option>
                    </select>
                </div>
                <div class="form-group d-flex">
                    <label for="">Chọn danh mục</label>
                    <select class="form-control" v-model="product.categoryId" name="parent_id" id="parent_id"
                            style="min-width: 140px; border: 1px solid; height: 42px; margin: 0 12px; border-radius: 6px"
                    >
                        <option value="">Chọn danh mục</option>
                        <option v-for="category in selectCategories" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <div class="form-group d-flex">
                    <label for="">Tên sản phẩm</label>
                    <input class="form-control" v-model="product.name" placeholder="product name..." style="border: 1px solid"/>
                </div>
                <div class="form-group d-flex">
                    <label for="">Số lượng sản phẩm</label>
                    <input type="number" min="0" max="999999999" class="form-control" v-model="product.quantity" placeholder="quantity..." style="border: 1px solid"/>
                </div>
                <div class="form-group d-flex">
                    <label for="">Đơn giá sản phẩm</label>
                    <input type="number" min="0" max="999999999" class="form-control" v-model="product.price" placeholder="price..." style="border: 1px solid"/>
                </div>
                <div class="form-group d-flex">
                    <label for="">Mô tả sản phẩm</label>
                    <textarea placeholder="mô tả sản phẩm..." class="form-control" name="" id="" cols="10" v-model="product.description" rows="3"></textarea>
                </div>
                <div class="form-group d-flex">
                    <label for="">Ảnh thương hiệu</label>
                    <input class="form-control" type="file" name="file" ref="fileInput">
                </div>
                <button class="btn-add" type="submit">Tạo mới</button>
            </form>
        </div>
    </div>
    <hr style="color: red; width: 100%">
    <div style="margin-top: 50px">
        <table class="table table-border table-primary">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên thương hiệu</th>
                <th>Ảnh</th>
                <th>Ngày tạo</th>
                <th>Tạo bởi</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="trademark in trademarks" :key="trademark.id">
                <td>{{ trademark.id }}</td>
                <td>{{ trademark.name }}</td>
                <td>{{ trademark.image }}</td>
                <td>{{ trademark.created_at }}</td>
                <td>{{ trademark.created_by }}</td>
                <td>
                    <a href="">Sửa</a>
                    <a href="">Xóa</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";
import trademark from "@/trademark/Trademark.vue";

export default {
    name: "Product",
    data() {
        return {
            trademarks: [],
            categories: [],
            selectCategories: [],
            trademarkId: '',
            product: {
                categoryId: '',
                name: '',
                price: '',
                description: '',
                quantity: '',
                image: '',
            },
            showCreateProduct: false
        };
    },
    mounted() {
        this.getTrademarks();
    },
    methods: {
        async getTrademarks() {
            let response = await axios.get('/api/trademark');
            if (response.data.code === 200) {
                response.data.data.map(trademark => {
                    if (trademark.parent_id === null) {
                        this.trademarks.push({
                            ...trademark,
                            showChildren: true
                        });
                    } else {
                        this.categories.push({
                            ...trademark,
                            showChildren: false
                        })
                    }
                });
                console.log(this.trademarks);
            }
        },

        selectCategory() {
            if (this.categories.length > 0) {
                this.selectCategories = this.categories.filter(item => item.parent_id === this.trademarkId)
            }
        },

        async addTrademark() {
            const formData = new FormData();
            const files = this.$refs.fileInput.files;
            formData.append('name', this.product.name);
            formData.append('trademark_id', this.product.categoryId);
            formData.append('quantity', this.product.quantity);
            formData.append('price', this.product.price);
            formData.append('description', this.product.description);
            if (files.length > 0) {
                formData.append('image', files[0]);
            }
            try {
                const response = await axios.post('/api/product', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                if (response.data.code === 200) {
                    this.newTrademark = '';
                    document.getElementById('parent_id').value = '';
                    await this.getTrademarks();
                } else {
                    alert('error create trademark');
                }
            } catch (error) {
                console.error(error);
            }
        },
        // async updateCategory(category) {
        //     let response = await axios.put(`/api/categories/${category.id}`, { name: category.name });
        //     if (response.data.code === 200) {
        //         await this.getCategories();
        //     }
        // },
        // async deleteCategory(id) {
        //     let response = await axios.delete(`/api/categories/${id}`);
        //     if (response.status === 204) {
        //         // this.trademark = this.trademark.filter(category => category.id !== id);
        //         await this.getCategories();
        //     }
        // },
        // toggleChildren(trademarkId) {
        //     this.categories.forEach(item => {
        //         if (item.id !== trademarkId) {
        //             item.showChildren = false;
        //         }
        //     });
        //     const category = this.categories.find(c => c.id === trademarkId);
        //     if (category && this.hasChildren(trademarkId)) {
        //         category.showChildren = !category.showChildren;
        //         this.categoryChild = this.categories.filter(c => c.parent_id === trademarkId);
        //     }
        // },
        // hasChildren(parentId) {
        //     return this.categories.some(category => category.parent_id === parentId);
        // },
        // async uploadFile() {
        //     const formData = new FormData();
        //     const files = this.$refs.fileInput.files;
        //     console.log('files', files)
        //     for (let i = 0; i < files.length; i++) {
        //         formData.append('file[]', files[i]);
        //     }
        //     try {
        //         // Gửi form data qua axios
        //         const response = await axios.post('/api/upload', formData, {
        //             headers: {
        //                 'Content-Type': 'multipart/form-data'
        //             }
        //         });
        //         console.log(response.data);
        //     } catch (error) {
        //         console.error(error);
        //     }
        // }
    }
};

</script>

<style scoped>
h1 {
    color: #42b983;
}
#create-trademark {
    width: 700px;
    height: auto;
    margin: auto;
    .form-group {
        margin-top: 10px;
        width: 100%;
        align-items: center;
        justify-content: space-between;
        label {
            width: 35%;
            display: flex;
            text-align: right;
        }
    }
    .form-control {
        width: 65%;
    }
    .btn-add {
        margin-top: 20px;
        margin-bottom: 10px;
        float: right;
        &:hover {
            background-color: #007bff;
        }
    }
}
button {
    width: 70px;
    height: 42px;
    border: 1px solid;
    border-radius: 6px;
    margin: 0 6px;
}
input {
    border: 1px solid greenyellow;
    font-size: 14px;
    color: #007bff;
    height: 42px;
    padding: 6px;
    border-radius: 6px;
    margin: 0 6px;
}
input:focus {
    outline: none; /* Xóa viền mặc định khi input được focus */
    border-color: #0066cc; /* Tùy chọn: thay đổi màu border khi focus */
}
</style>
