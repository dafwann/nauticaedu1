<template>
  <div class="admin-komunitas">

    <!-- Header -->
    <div class="page-header">
      <div class="header-content">
        <div class="header-text">
          <h1>🤝 Management Volunteer</h1>
          <p>Kelola data volunteer yang muncul di halaman community</p>
          <div class="page-notice">
            💡 Volunteer dengan status "aktif" akan tampil di halaman volunteer
          </div>
        </div>

        <div class="header-actions">
          <button @click="showAdd = true" class="btn-primary">➕ Tambah Volunteer</button>
        </div>
      </div>
    </div>

    <!-- Tabel -->
    <div class="table-section">
      <div class="table-container">

        <div class="table-header">
          <div class="table-info">Total {{ volunteer.length }} volunteer</div>
        </div>

        <div class="table-wrapper">
          <table class="komunitas-table">
            <thead>
              <tr>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Link</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="item in volunteer" :key="item.id">

                <td>
                  <div class="image-preview" @click="showImagePreview(item.foto)">
                    <img :src="item.foto" :alt="item.nama" class="thumbnail-preview">
                    <span class="preview-hint">👁️ Preview</span>
                  </div>
                </td>

                <td>{{ item.nama }}</td>

                <td>
                  <a :href="item.link" target="_blank" class="external-link" @click.stop>🔗 Buka Link</a>
                  <div class="link-url">{{ truncateUrl(item.link) }}</div>
                </td>

                <td>
                  <span class="status-badge" :class="item.status">
                    {{ item.status === "aktif" ? "Aktif" : "Non-Aktif" }}
                  </span>
                </td>

                <td>
                  <div class="action-buttons">
                    <button class="btn-action edit" @click="openEdit(item)">✏️</button>
                  </div>
                </td>

              </tr>
            </tbody>
          </table>

          <!-- Empty -->
          <div v-if="volunteer.length === 0" class="empty-state">
            <div class="empty-icon">🤝</div>
            <h3>Belum ada volunteer</h3>
            <button @click="showAdd = true" class="btn-primary">➕ Tambah Volunteer Pertama</button>
          </div>

        </div>
      </div>
    </div>

    <!-- ADD Modal -->
    <div v-if="showAdd" class="modal-backdrop" @click="showAdd = false">
      <div class="modal" @click.stop>

        <div class="modal-header">
          <h3>➕ Tambah Volunteer</h3>
          <button class="modal-close" @click="showAdd = false">×</button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label>Nama *</label>
            <input v-model="newData.nama" class="form-input" type="text">
          </div>

          <div class="form-group">
            <label>Link *</label>
            <input v-model="newData.link" class="form-input" type="url">
          </div>

          <div class="form-group">
            <label>URL Foto *</label>
            <input v-model="newData.foto" class="form-input" type="url">
            <div class="image-preview-small" v-if="newData.foto">
              <img :src="newData.foto" @error="handleImageError">
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn-secondary" @click="showAdd = false">Batal</button>
          <button class="btn-primary" @click="addVolunteer" :disabled="!validNew">💾 Simpan</button>
        </div>

      </div>
    </div>

    <!-- EDIT Modal -->
    <div v-if="editing" class="modal-backdrop" @click="cancelEdit">
      <div class="modal" @click.stop>

        <div class="modal-header">
          <h3>✏️ Edit Volunteer</h3>
          <button class="modal-close" @click="cancelEdit">×</button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label>Nama *</label>
            <input v-model="editing.nama" class="form-input" type="text">
          </div>

          <div class="form-group">
            <label>Link *</label>
            <input v-model="editing.link" class="form-input" type="url">
          </div>

          <div class="form-group">
            <label>URL Foto *</label>
            <input v-model="editing.foto" class="form-input" type="url">
            <div class="image-preview-small" v-if="editing.foto">
              <img :src="editing.foto" @error="handleImageError">
            </div>
          </div>

          <div class="form-group">
            <label>Status</label>
            <select v-model="editing.status" class="form-select">
              <option value="aktif">Aktif</option>
              <option value="non-aktif">Non-Aktif</option>
            </select>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn-secondary" @click="cancelEdit">Batal</button>
          <button class="btn-primary" @click="updateVolunteer">💾 Update</button>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";

const API = "http://localhost:8000/api/events"; // ← FIX MASALAHNYA DI SINI

const volunteer = ref([]);

// Data untuk tambah
const showAdd = ref(false);
const newData = ref({
  nama: "",
  link: "",
  foto: "",
  status: "aktif",
});

const validNew = computed(() =>
  newData.value.nama && newData.value.link && newData.value.foto
);

// Data untuk edit
const editing = ref(null);

// GET /events
const fetchData = async () => {
  try {
    const r = await fetch(API);
    const res = await r.json();

    // EXPECTED: { status: true, data: [...] }
    volunteer.value = res.data || [];

  } catch (e) {
    console.error("Fetch error:", e);
    volunteer.value = [];
  }
};

// POST /events
const addVolunteer = async () => {
  await fetch(API, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      nama: newData.value.nama,
      link: newData.value.link,
      foto: newData.value.foto,
      status: "aktif",
    }),
  });

  showAdd.value = false;
  newData.value = { nama: "", link: "", foto: "", status: "aktif" };
  fetchData();
};

// OPEN EDIT
const openEdit = (item) => {
  editing.value = { ...item };
};

// PUT /events/{id}
const updateVolunteer = async () => {
  await fetch(`${API}/${editing.value.id}`, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(editing.value),
  });

  editing.value = null;
  fetchData();
};

// DELETE /events/{id}
const deleteVolunteer = async (item) => {
  if (!confirm(`Hapus "${item.nama}"?`)) return;

  await fetch(`${API}/${item.id}`, {
    method: "DELETE",
  });

  fetchData();
};

// PATCH status /events/{id}/status
const toggleStatus = async (item) => {
  const newStatus = item.status === "aktif" ? "non-aktif" : "aktif";

  await fetch(`${API}/${item.id}/status`, {
    method: "PATCH",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ status: newStatus }),
  });

  fetchData();
};

const cancelEdit = () => (editing.value = null);

const showImagePreview = (url) => window.open(url, "_blank");

const truncateUrl = (url) =>
  url.length > 40 ? url.slice(0, 37) + "..." : url;

const handleImageError = (e) => (e.target.style.display = "none");

// LOAD
onMounted(fetchData);
</script>


<style scoped>
    .admin-komunitas {
    min-height: 100vh;
    background: #f8f9fa;
    padding-bottom: 20px;
    font-family: karla, serif;
    }

    /* Header */
    .page-header {
    background: white;
    padding: 24px 30px;
    border-bottom: 1px solid #e9ecef;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    }

    .header-text h1 {
    margin: 0 0 8px 0;
    font-size: 28px;
    color: #2c3e50;
    font-weight: 700;
    }

    .header-text p {
    margin: 0;
    color: #6c757d;
    font-size: 16px;
    }

    .page-notice {
    background: #e3f2fd;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 14px;
    color: #1976d2;
    margin-top: 8px;
    border-left: 4px solid #2196f3;
    }

    .header-actions {
    display: flex;
    gap: 12px;
    }

    /* Buttons */
    .btn-primary {
    background: #3498db;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
    }

    .btn-primary:hover {
    background: #2980b9;
    transform: translateY(-1px);
    }

    .btn-secondary {
    background: #95a5a6;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
    }

    .btn-secondary:hover {
    background: #7f8c8d;
    }

    /* Table */
    .table-section {
    padding: 20px 30px;
    }

    .table-container {
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
    overflow: hidden;
    position: relative;
    z-index: 2;
    }

    .table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid #e9ecef;
    }

    .table-info {
    color: #6c757d;
    font-size: 14px;
    }

    .table-wrapper {
    overflow-x: auto;
    }

    .komunitas-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    }

    /* Lebar kolom */
    .komunitas-table th:nth-child(1),
    .komunitas-table td:nth-child(1) {
    width: 120px; /* Gambar */
    }

    .komunitas-table th:nth-child(2),
    .komunitas-table td:nth-child(2) {
    width: 250px; /* Nama Komunitas */
    }

    .komunitas-table th:nth-child(3),
    .komunitas-table td:nth-child(3) {
    width: 200px; /* Penyelenggara */
    }

    .komunitas-table th:nth-child(4),
    .komunitas-table td:nth-child(4) {
    width: 300px; /* Link */
    }

    .komunitas-table th:nth-child(5),
    .komunitas-table td:nth-child(5) {
    width: 100px; /* Status */
    }

    .komunitas-table th:nth-child(6),
    .komunitas-table td:nth-child(6) {
    width: 150px; /* Aksi */
    }

    .komunitas-table th,
    .komunitas-table td {
    padding: 16px;
    text-align: left;
    border-bottom: 1px solid #ecf0f1;
    }

    .komunitas-table th {
    background: #f8f9fa;
    font-weight: 600;
    color: #2c3e50;
    font-size: 14px;
    }

    .komunitas-table td {
    font-size: 14px;
    color: #2c3e50;
    }

    .komunitas-table tr:hover {
    background: #f8f9fa;
    }

    /* Image preview */
    .image-preview {
    position: relative;
    width: 80px;
    height: 60px;
    border-radius: 6px;
    overflow: hidden;
    cursor: pointer;
    }

    .thumbnail-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    }

    .preview-hint {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    opacity: 0;
    transition: opacity 0.3s;
    }

    .image-preview:hover .preview-hint {
    opacity: 1;
    }

    /* Text cells */
    .komunitas-title-cell .komunitas-nama {
    font-weight: 600;
    line-height: 1.3;
    word-wrap: break-word;
    }

    .penyelenggara-cell {
    font-size: 14px;
    color: #6c757d;
    }

    /* Link cell */
    .link-cell {
    max-width: 300px;
    }

    .external-link {
    color: #3498db;
    text-decoration: none;
    font-size: 12px;
    font-weight: 500;
    }

    .external-link:hover {
    text-decoration: underline;
    }

    .link-url {
    font-size: 11px;
    color: #6c757d;
    margin-top: 4px;
    word-break: break-all;
    }

    /* Status badges */
    .status-badge {
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    }

    .status-badge.published {
    background: #e8f5e8;
    color: #27ae60;
    }

    .status-badge.draft {
    background: #fff3e0;
    color: #f57c00;
    }

    /* Action buttons */
    .action-buttons {
    display: flex;
    gap: 8px;
    }

    .btn-action {
    background: none;
    border: none;
    padding: 8px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s;
    }

    .btn-action.edit:hover {
    background: #3498db;
    color: white;
    }

    .btn-action.publish:hover {
    background: #27ae60;
    color: white;
    }

    .btn-action.unpublish:hover {
    background: #f39c12;
    color: white;
    }

    .btn-action.delete:hover {
    background: #e74c3c;
    color: white;
    }

    /* Empty state */
    .empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
    }

    .empty-icon {
    font-size: 48px;
    margin-bottom: 16px;
    }

    .empty-state h3 {
    margin: 0 0 8px 0;
    color: #2c3e50;
    }

    .empty-state p {
    margin: 0 0 20px 0;
    }

    /* Modals */
    .modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    }

    .modal {
    background: white;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px;
    border-bottom: 1px solid #e9ecef;
    }

    .modal-header h3 {
    margin: 0;
    color: #2c3e50;
    }

    .modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #6c757d;
    }

    .modal-body {
    padding: 24px;
    }

    .modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding: 24px;
    border-top: 1px solid #e9ecef;
    }

    /* Form styles */
    .form-group {
    margin-bottom: 20px;
    }

    .form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #2c3e50;
    }

    .form-input,
    .form-select {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    box-sizing: border-box;
    }

    .form-input:focus,
    .form-select:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    .image-preview-small {
    margin-top: 8px;
    width: 100px;
    height: 75px;
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid #ddd;
    }

    .image-preview-small img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    }

    /* Responsive */
    @media (max-width: 768px) {
    .page-header {
        padding: 20px;
    }
    
    .header-content {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
    }
    
    .table-section {
        padding: 20px;
    }
    
    .komunitas-table {
        font-size: 12px;
    }
    
    .komunitas-table th,
    .komunitas-table td {
        padding: 12px 8px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 4px;
    }
    
    .modal {
        width: 95%;
        margin: 20px;
    }
    }

    @media (max-width: 480px) {
    .header-text h1 {
        font-size: 24px;
    }
    }
</style>