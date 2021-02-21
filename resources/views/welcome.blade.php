<x-app-layout>

    <div class="mr-20 ml-20">
        <x-slot name="header">
            <h2>
                {{ __('Welcome Page') }}
            </h2>
        </x-slot>
    <div class="my-10">
        <p class="text-center font-bold text-2xl">Welcome!</p>
        <div class="text-lg p-4">On this page you can upload list which you can download from "Employes" page then edit it and then upload here. To navigate to "Employes" page you can press "Employes" in the left upper corner.</div>
        <div class="text-lg p-4">After edited list being uploaded, the changes will be reflected in DB and you will be able to see them in list.</div>
        <div class="text-lg p-4">If you assign some new role or department to the employe this will be reflected in lists of employe and departments. So on "Employes" page you'll be able to choose from this department.</div>
        <div class="text-lg p-4">The structure of xml file must remain according to the downloaded one, however if you wish to add new employe, leave the value of "id" tag as blank but the tag itself must remain. And all the employes with blank "id" tag will be considered as new. If you wish all the employes from the list to be considered as new, press "Upload all employes as new" <span class="text-red-500">Important!!!</span> Do not use "Upload all employes as new" with extra large data because this functionality is not yet optimized for it.</div>

    </div>

        <form class="flex p-2" name="uploadxml" action="" onsubmit="return validateFormOnSubmit(this);">
            @csrf
            Select XML list of employes to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <div class="lds-dual-ring" style="display: none;" id="waitspinner"></div>
            <input class="p-2 rounded-md bg-green-200 hover:bg-gray-400 active:bg-green-400 focus:outline-none" type="submit" value="Upload employes" name="submit">
        </form>
    

    
        <form class="flex p-2" name="uploadxmlasnew" action="" onsubmit="return validateFormOnSubmitasnew(this);">
            @csrf
            Select XML list of employes to upload:
            <input type="file" name="fileToUpload" id="fileToUpload1">
            <div class="lds-dual-ring" style="display: none;" id="waitspinner1"></div>
            <input class="p-2 rounded-md bg-green-200 hover:bg-gray-400 active:bg-green-400 focus:outline-none" type="submit" value="Upload all employes as new" name="submit">
        </form>
    
    </div>


    
</x-app-layout>