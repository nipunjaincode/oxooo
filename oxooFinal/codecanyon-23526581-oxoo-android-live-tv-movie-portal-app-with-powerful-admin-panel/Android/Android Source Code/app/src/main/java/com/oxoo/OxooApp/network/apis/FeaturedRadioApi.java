package com.oxoo.OxooApp.network.apis;

import com.oxoo.OxooApp.network.model.RadioModel;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Header;

public interface FeaturedRadioApi {

    @GET("featured_radio")
    Call<List<RadioModel>> getFeaturedRadio(@Header("API-KEY") String apiKey);
}
