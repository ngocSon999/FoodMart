<template>
    <div>
        <h1>Categories</h1>
        <form @submit.prevent="addCategory" style="display: flex; justify-content: center">
            <div>
                <label for="">chon danh muc cha</label>
                <select v-model="categoryId" name="parent_id" id="parent_id"
                        style="min-width: 140px; border: 1px solid; height: 42px; margin: 0 12px; border-radius: 6px"
                >
                    <option value="">---</option>
                    <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                </select>
            </div>
            <div>
                <input v-model="newCategory" placeholder="New category" style="border: 1px solid"/>
                <button type="submit">Add</button>
            </div>
        </form>
    </div>
    <div style="margin-top: 50px">

        <ul style="border: 1px solid green">
            <li class="list-parent-category" v-for="category in categories" :key="category.id">
                <div v-if="category.parent_id == null">
                    <input v-model="category.name"/>
                    <button @click="updateCategory(category)">update</button>
                    <button v-if="category.name" @click="deleteCategory(category.id)">Delete</button>
                    <button v-if="hasChildren(category.id)" style="width: 90px" @click="toggleChildren(category.id)">xem them</button>
                </div>
                <ul v-show="category.showChildren">
                    <li v-for="child in categoryChild" :key="child.id">
                        <input v-model="child.name"/>
                        <button @click="updateCategory(child)">Update</button>
                        <button v-if="child.name" @click="deleteCategory(child.id)">Delete</button>
                        <button v-if="hasChildren(child.id)" style="width: 90px" @click="toggleChildren(child.id)">xem them</button>
                    </li>
                </ul>
            </li>
        </ul>

        <form @submit.prevent="uploadFile" enctype="multipart/form-data">
            <input type="file" name="file[]" multiple ref="fileInput">
            <button type="submit">add</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            categories: [],
            newCategory: '',
            categoryId: '',
            show: true,
            categoryChild: []
        };
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        async getCategories() {
            let response = await axios.get('/api/categories');
            if (response.data.code === 200) {
                this.categories = response.data.data.map(category => ({
                    ...category,
                    showChildren: false
                }));
            }
        },
        async addCategory() {
            let response = await axios.post('/api/categories',
                {
                    name: this.newCategory,
                    parent_id: this.categoryId
                }
            );
            if (response.data.code === 200) {
                await this.getCategories();
                this.newCategory = '';
                document.getElementById('parent_id').value = '';
            } else {
                alert('error create category');
            }
        },
        async updateCategory(category) {
             let response = await axios.put(`/api/categories/${category.id}`, { name: category.name });
             if (response.data.code === 200) {
                 await this.getCategories();
             }
        },
        async deleteCategory(id) {
            let response = await axios.delete(`/api/categories/${id}`);
            if (response.status === 204) {
                // this.trademark = this.trademark.filter(category => category.id !== id);
                await this.getCategories();
            }
        },
        toggleChildren(categoryId) {
            this.categories.forEach(item => {
                if (item.id !== categoryId) {
                    item.showChildren = false;
                }
            });
            const category = this.categories.find(c => c.id === categoryId);
            if (category && this.hasChildren(categoryId)) {
                category.showChildren = !category.showChildren;
                this.categoryChild = this.categories.filter(c => c.parent_id === categoryId);
            }
        },
        hasChildren(parentId) {
            return this.categories.some(category => category.parent_id === parentId);
        },
        async uploadFile() {
            const formData = new FormData();
            const files = this.$refs.fileInput.files;
            console.log('files', files)
            for (let i = 0; i < files.length; i++) {
                formData.append('file[]', files[i]);
            }
            try {
                // Gửi form data qua axios
                const response = await axios.post('/api/upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                console.log(response.data);
            } catch (error) {
                console.error(error);
            }
        }
    }
};
</script>

<style scoped>
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
