<div style="width:100%;background-color:#f2f2f2;font-size:14px;font-family:arial;color:#222;max-width:750px">
    <div class="adM">
    </div>
    <table cellpadding="0" cellspacing="0" width="95%" style="width:95%;margin:0 2.5%;display:block;padding-top:15px">
        <tbody style="background-color:#fff">
            <tr>
                <td>
                    <img src="http://i.imgur.com/0mLuhry.png" alt="logo kembabyshop.com.vn" style="margin-left:8px;margin-top:10px;min-height:52px;width:280px" class="CToWUd">
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dad9de;padding:0px;padding-top:5px">
                    <table cellpadding="0" cellspacing="0" width="calc(100% - 30px)" style="padding:0 15px">
                        <tbody>
                            <tr>
                                <td style="background-color:#ff3366;color:#fff;font-weight:bold;width:calc(100% - 10px);height:26px;display:block;font-size:15px;line-height:26px;padding-left:10px;margin:10px auto">
                                    <span style="font-size:14px">Thông báo đơn hàng</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="line-height:20px;padding:5px 0">
                                    <span style="font-size:14px">Xin chào <b>{{$customer->last_name . ' ' . $customer->first_name}} </b>,</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="line-height:20px;padding:5px 0">
                                    <span style="font-size:14px">Cảm ơn bạn đã cho chúng tôi có cơ hội được phục vụ.</span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="line-height:20px;padding:5px 0">
                                    <span style="font-size:14px">Trung tâm chăm sóc khách hàng </span> 
                                    <a href="https://kembabyshop.com.vn" style="text-decoration:none;color:#ff3366;font-size:14px" target="_blank">Kembabyshop.com.vn</a>
                                    <span style="font-size:14px"> sẽ liên hệ trực tiếp với bạn để xác nhận đơn hàng này. </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#f2f2f2;color:#222;font-weight:bold;width:calc(100% - 10px);height:26px;display:block;font-size:15px;line-height:26px;padding-left:10px;margin:10px auto">
                                    <span style="font-size:14px">Thông tin người nhận hàng</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="width:50%;min-width:260px;float:left;margin-right:2%;margin-bottom:15px">
                                        <span style="display:block;margin:9px 0;margin-top:3px">Họ và tên: <b>{{$customer->last_name . ' ' . $customer->first_name}}</b></span>
                                        <span style="display:block;margin:9px 0">Điện thoại: {{$customer->phone}}</span>
                                        <span style="display:block;margin:9px 0">Email: <a href="javascript:void(0)" target="_blank">{{$customer->email}}</a></span>
                                        <span style="display:block;margin:9px 0;line-height:20px">Địa chỉ: {{$customer->address}}</span>
                                    </div>
                                    <!-- <div style="width:45%;min-width:250px;float:left;margin-bottom:15px">
                                        <span style="display:block;margin:9px 0;margin-top:3px">Mã đơn hàng: <b style="font-weight:normal!important;color:red">PC5207BFD3AF1B4</b></span>
                                        <span style="display:block;margin:9px 0">Thanh toán: Thanh toán tại nhà</span>
                                        <span style="display:block;margin:9px 0">Thời gian nhận hàng: Ngoài giờ hành chính</span>
                                    </div> -->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" width="100%" style="border-top:1px solid #ddd;border-left:1px solid #ddd">
                                        <tbody>
                                            <tr style="background:#fafafa;height:30px">
                                                <th width="40%" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd">Tên sản phẩm </th>
                                                <th width="25%" align="center" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd">Giá</th>
                                                <th width="10%" align="center" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd">SL</th>
                                                <th width="25%" align="center" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd">Thành tiền</th>
                                            </tr>

                                            @foreach ($carts as $cart)
                                                <tr>
                                                    <td align="left" style="border-right:1px solid #ddd;padding-left:5px;padding-bottom:5px">
                                                        <span style="padding-top:10px; display:block; text-align: center;">
                                                            <a style="color:#222;text-decoration:none;font-size:13px" href="https://kembabyshop.com.vn/sua-icreo-glico-nhat-ban-so-0" target="_blank">{{$cart->name}}</a>
                                                        </span> 
                                                    </td>
                                                    <td align="center" style="border-right:1px solid #ddd">
                                                        <span style="font-size:13px;display:block;padding-top:5px">{{number_format($cart->price)}} ₫</span>
                                                    </td>
                                                    <td align="center" style="border-right:1px solid #ddd">
                                                        <span style="font-size:13px">{{$cart->qty}}</span> 
                                                    </td>
                                                    <td align="center" style="border-right:1px solid #ddd">
                                                        <span style="font-size:13px">{{number_format($cart->subtotal)}} ₫</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                            <tr>
                                                <td colspan="4" align="left" style="border-top:#dddddd dotted 1px;border-right:1px solid #ddd;padding-left:5px;padding-bottom:5px">
                                                    <!-- <div style="padding:10px">
                                                        <span style="color:red;display:block">KHUYẾN MẠI</span>
                                                        <span style="font-size:13px;text-align:justify">
                                                        “Cảm ơn mẹ đã tin chọn Glico Icreo”:&nbsp;Khách hàng mua&nbsp;sữa Glico Icreo&nbsp;có dán tem khuyến mãi sẽ có cơ hội đổi tem lấy những phần quà vô cùng hấp dẫn. Chương trình áp dụng trên toàn quốc, đến hết ngày 30/06/2016. Để biết thêm&nbsp;thông tin quà tặng, cách thức đổi quà, địa điểm đổi quà, quý khách truy cập&nbsp;TẠI ĐÂY!
                                                        </span>
                                                    </div> -->
                                                </td>
                                            </tr>
                                            <tr style="background:#fafafa">
                                                <td style="padding:10px 6px;border-bottom:1px solid #ddd;border-right:1px solid #ddd" colspan="4">
                                                    <div style="float:right;text-align:right;line-height:20px">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align:right">Tạm tính: </td>
                                                                    <td style="text-align:right"><span style="color:#222;font-size:15px;width:95px;display:inline-block">{{number_format($priceTotal)}} ₫</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align:right">Tổng giá trị đơn hàng: </td>
                                                                    <td style="text-align:right"><b style="color:red;font-size:18px;width:95px;display:inline-block">{{number_format($priceTotal)}} ₫</b></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="float:right;font-size:12px;width:100%;text-align:right;margin-right:10px">
                                        Ngày đặt hàng: {{$date}}
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table cellpadding="0" cellspacing="0" width="95%" style="width:95%;margin:0 2.5%;display:block;padding-bottom:20px;margin-top:10px;max-width:616px">
        <tbody>
            <tr>
                <td>
                    <div style="max-width:425px;float:left;margin-bottom:10px">
                        <table cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="tel:1900%206483" style="text-decoration:none;color:#15c;font-size:14px" target="_blank"><img src="https://ci3.googleusercontent.com/proxy/otr-rCQbQnR9HQedTihPiLlP3BSfT627XYC6s9tBBCiXuG00GlvRWPM2lYZt-4ozLaFe6T_Cw17LaJ6BrfaPX4uCnGQhfc7upKtjSFNzwg=s0-d-e1-ft#http://media.shoptretho.com.vn/upload/km/Icon/Hotline.png" alt="Phone Kembabyshop.com.vn" class="CToWUd"> 0983-572-636</a>
                                        <a href="mailto:cskh@Kembabyshop.com.vn" style="font-size:14px;text-decoration:none;color:#15c;margin-left:4px;display:inline-block" target="_blank"><img src="https://ci5.googleusercontent.com/proxy/ypa6qMFWglXymUV4z4voeta4nezs_OWweLtMjbzDHnPlgMc99ZgLAghbWAmo_wQ_uBrJFkho5cvh-nCT28dLr15P9D4SOcCj2apyZJedsjinRQ=s0-d-e1-ft#http://media.shoptretho.com.vn/upload/km/Icon/Head-phone.png" alt="Hotline ShopTreTho.com.vn" class="CToWUd"> cskh@Kembabyshop.com.vn</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="line-height:20px;padding:5px 0">
                                        <b style="font-size:13px;padding-top:5px;font-size:14px">© 2016 <a href="https://ShopTreTho.com.vn" style="text-decoration:none;color:#222" target="_blank">Kembabyshop.com.vn</a> - Thiên đường cho Mẹ và Bé!</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#888;font-size:12px;line-height:18px;padding-right:10px">
                                        GPĐKKD số 0104406702 do sở KHĐT TP.Hà Nội cấp ngày 28/01/2010. Giấy phép MXH số 06/GXN-TTĐT do Cục QL Phát thanh, Truyền hình và TTĐT cấp ngày 16/01/2013.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="float:right;width:106px;margin:12px 0 8px 0;text-align:right">
                        <a href="https://www.facebook.com/shoptrethovn" target="_blank"><img src="https://ci6.googleusercontent.com/proxy/Zr3RCWpWf7zB_gwC4AUUApBBRCDieDQ8XT4IjfKjJIKHdvA2izpmqsOrAF4EDeXNr2GBnNxfDa3keQa_QjEvQmMGLP5iJNTBDA=s0-d-e1-ft#http://media.shoptretho.com.vn/upload/km/Icon/F.png" alt="facebook shoptretho" class="CToWUd"></a>
                        <!-- <a href="https://twitter.com/shoptretho" target="_blank"><img src="https://ci5.googleusercontent.com/proxy/q4e4IWOY4kIJ1FTGsCJpFl9m10EInjgzuHyx2hYSO33Vnc4QO2sOpvizsrMIT-_D2Vef74-kn9YNV3CIziMMfG0eGf65tTjcbQ=s0-d-e1-ft#http://media.shoptretho.com.vn/upload/km/Icon/T.png" alt="twiter shoptretho" class="CToWUd"></a> -->
                        <a href="https://plus.google.com/+shoptrethoonline" style="margin-right:26px" target="_blank"><img src="https://ci6.googleusercontent.com/proxy/5wYvGzgyWHsWZyfHOb8BvIuWSNrpWqK3gIBKm3WfCA2p-bugTSykRjYw3UY04ahWxD8K4oSXU2Cgsq58tpsNEZTIm3vq7t5pig=s0-d-e1-ft#http://media.shoptretho.com.vn/upload/km/Icon/G.png" alt="G+ shoptretho" class="CToWUd"></a>
                    </div>
                    <!-- <div style="width:160px;min-height:47px;display:block;border-radius:3px;float:left">
                        <a href="https://shoptretho.com.vn/lien-he" target="_blank">
                        <img src="https://ci6.googleusercontent.com/proxy/dXeDxALgvKP7sVd1_au69cQBV80k5AB_F8hM8Qm9sfGRtdfPrgUVgSJeKKOgu7rhNhuLEUhqCIQ34CgENGOu3asBlKOHQohUvn3ZPh3S5IX7TnJ3JHwghvbEqFdA6_CLxbnC=s0-d-e1-ft#http://media.shoptretho.com.vn/upload/km/Icon/icon-xem-danh-sach-cua-hang.png" alt="Danh sách cửa hàng shoptretho" width="160" class="CToWUd">
                        </a>
                    </div> -->
                </td>
            </tr>
        </tbody>
    </table>
    <div class="yj6qo"></div>
    <div class="adL">
    </div>
</div>