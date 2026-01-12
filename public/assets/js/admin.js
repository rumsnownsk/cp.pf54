// код для Админки

const sField = document.getElementById('search');
const tableWorks = document.getElementById('table_works');
const tBodyWorks = tableWorks.getElementsByTagName('tbody')[0]

// ==========================================================
// БЛОК ОБЩИХ ВСПОМОГАТЕЛЬНЫХ ФУНКЦИЙ
// ==========================================================

function showToast(message, type = 'success') {
    const toastContainer = $('#toastContainer');
    if (!toastContainer) return;
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `
            <div class="toast-header">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                ${type === 'success' ? 'Успех' : 'Ошибка'}
            </div>
            <div class="toast-body">${message}</div>
        `;
    toastContainer.appendChild(toast);
    setTimeout(() => {
        toast.style.animation = 'slideInRight 0.3s ease reverse';
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }, 5000);
}

const showError = (msg) => {
    const errorMsg = typeof msg === 'string' ? msg : (msg?.message || 'Произошла неизвестная ошибка');
    showToast(errorMsg, 'error');
};

/**
 * @param {string} url
 * @param opts
 */
async function fetchJson(url, opts = {}) {
    try {
        const response = await fetch(url, opts);

        // Проверка на сетевые ошибки
        if (!response.ok) {
            throw new Error(`HTTP ошибка! Статус: ${response.status} ${response.statusText}`);
        }
        return await response.json();
    } catch (e) {
        console.error('Ошибка при запросе:', e.message);
        throw e; // Перебрасываем ошибку для обработки в вызывающем коде
    }
}

// ==========================================================
// ОКОНЧАНИЕ БЛОКА ОБЩИХ ВСПОМОГАТЕЛЬНЫХ ФУНКЦИЙ
// ==========================================================


sField.addEventListener('input', (e) => {
    let search = e.target.value.trim()
    if (search.length > 1) {
        loadTbodyWorks(search)

    } else if (search.length === 0) {
        loadTbodyWorks(null)
    }
})

document.getElementById('clear-search').addEventListener('click', () => {
    sField.value = ''
    loadTbodyWorks(null)
})

async function loadTbodyWorks(strSearch, page) {
    try {
        let getParams = new URLSearchParams()

        strSearch && getParams.append('strSearch', strSearch)
        page && getParams.append('page', page)

        const res = await fetchJson(`/tBodyWorks?${getParams}`, {
            method: 'get',
            headers: {'Content-Type': 'application/json'}
        })

        const paginationField = document.querySelectorAll('.paginationField');
        paginationField.forEach(paginationField => {
            paginationField.innerHTML = res.pagination
        })


        if (strSearch === null) {
            tBodyWorks.innerHTML = ""
            tBodyWorks.insertAdjacentHTML('beforeend', res.tBody)
        } else {
            tBodyWorks.innerHTML = ""
            tBodyWorks.insertAdjacentHTML('beforeend', res.tBody)
        }
    } catch (e) {
        showError(e);
        throw e;
    }
}

const divContent = document.querySelector('.content')
divContent.addEventListener('click', (e) => {
    if (e.target.className === 'page-link') {
        e.preventDefault()
        let page = +e.target.dataset.page;
        loadTbodyWorks(null, page)
        // console.log(page)
    }
})

window.addEventListener('DOMContentLoaded', async () => {
    try {
        await loadTbodyWorks();
    } catch (e) {
        console.error('Initialization error:', e.message);
    }
})