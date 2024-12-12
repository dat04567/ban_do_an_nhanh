
const CartTemplates = {
    default: (item, items, increase, decrease) => `
        <li class="list-group-item py-3 ps-0 ${items.indexOf(item) === 0 ? 'border-top' : ''} ${items.indexOf(item) === items.length - 1 ? 'border-bottom' : ''}">
            <div class="row align-items-center">
                <div class="col-6 col-md-6 col-lg-7">
                    <div class="d-flex">
                        <img src="${item.hinhAnh[0]}" alt="${item.tenSanPham}" class="icon-shape icon-xxl" />
                        <div class="ms-3">
                            <a href="#" class="text-inherit">
                                <h6 class="mb-0">${item.tenSanPham}</h6>
                            </a>
                            <span><small class="text-${item.soLuongTon > 0 ? 'muted' : 'danger'}">
                                ${item.soLuongTon > 0 ? `Còn ${item.soLuongTon} sản phẩm` : 'Hết hàng'}
                            </small></span>
                            <div class="mt-2 small lh-1">
                                <button class="btn  p-0  text-inherit delete-item" data-id="${item.idSanPham}">
                                    <span class="me-1 align-text-bottom">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-success">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </span>
                                    <span class="text-muted">Xóa</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-3 col-lg-3">
                    <div class="input-group input-spinner">
                        ${increase}
                        <input type="number" step="1" max="${item.soLuongTon}" value="${item.soLuong}" class="quantity-field form-control-sm form-input ${item.soLuongTon <= 0 ? 'border-0' : ''}" ${item.soLuongTon <= 0 ? 'disabled' : ''} />
                        ${decrease}
                    </div>
                </div>
                <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                    <span class="fw-bold">${new Intl.NumberFormat('vi-VN').format(item.totalPrice)}đ</span>
                </div>
            </div>
        </li>
    `,


};

export default CartTemplates;