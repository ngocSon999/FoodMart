<template>
    <div class="" style="margin-top: 20px">
        <h1>Thương hiệu</h1>
        <form @submit.prevent="addTrademark" id="create-trademark" enctype="multipart/form-data">
            <div class="form-group d-flex">
                <label for="">Chọn thương hiệu cha</label>
                <select class="form-control" v-model="trademarkId" name="parent_id" id="parent_id"
                        style="min-width: 140px; border: 1px solid; height: 42px; margin: 0 12px; border-radius: 6px"
                >
                    <option value="">--Chọn danh mục cha--</option>
                    <option v-for="trademark in trademarks" :value="trademark.id">{{ trademark.name }}</option>
                </select>
            </div>
            <div class="form-group d-flex">
                <label for="">Tên thương hiệu</label>
                <input class="form-control" v-model="newTrademark" placeholder="New trademark" style="border: 1px solid"/>
            </div>
            <div class="form-group d-flex">
                <label for="">Ảnh thương hiệu</label>
                <input class="form-control" type="file" name="file" ref="fileInput">
            </div>
            <button class="btn-add" type="submit">Add</button>
        </form>
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

<!--        <ul style="border: 1px solid green">-->
<!--            <li class="list-parent-category" v-for="category in categories" :key="category.id">-->
<!--                <div v-if="category.parent_id == null">-->
<!--                    <input v-model="category.name"/>-->
<!--                    <button @click="updateCategory(category)">update</button>-->
<!--                    <button v-if="category.name" @click="deleteCategory(category.id)">Delete</button>-->
<!--                    <button v-if="hasChildren(category.id)" style="width: 90px" @click="toggleChildren(category.id)">xem them</button>-->
<!--                </div>-->
<!--                <ul v-show="category.showChildren">-->
<!--                    <li v-for="child in categoryChild" :key="child.id">-->
<!--                        <input v-model="child.name"/>-->
<!--                        <button @click="updateCategory(child)">Update</button>-->
<!--                        <button v-if="child.name" @click="deleteCategory(child.id)">Delete</button>-->
<!--                        <button v-if="hasChildren(child.id)" style="width: 90px" @click="toggleChildren(child.id)">xem them</button>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
<!--        </ul>-->
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Trademark",
    data() {
        return {
            trademarks: [],
            newTrademark: '',
            trademarkId: '',
            show: true,
            trademarkChild: []
        };
    },
    mounted() {
        this.getTrademarks();
    },
    methods: {
        async getTrademarks() {
            let response = await axios.get('/api/trademark');
            if (response.data.code === 200) {
                this.trademarks = response.data.data.map(trademark => ({
                    ...trademark,
                    showChildren: false
                }));
            }
        },
        async addTrademark() {
            const formData = new FormData();
            const files = this.$refs.fileInput.files;
            formData.append('name', this.newTrademark);
            formData.append('parent_id', this.trademarkId);
            if (files.length > 0) {
                formData.append('image', files[0]);
            }
            try {
                const response = await axios.post('/api/trademark', formData, {
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
