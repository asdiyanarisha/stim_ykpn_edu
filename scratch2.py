with open("resources/js/Pages/Content/CertificationLogo/index.vue", "r") as f:
    c = f.read()
c = c.replace("logo-kerja", "logo-sertifikasi")
with open("resources/js/Pages/Content/CertificationLogo/index.vue", "w") as f:
    f.write(c)

with open("resources/js/Pages/Content/CertificationLogo/CertificationLogoForm.vue", "r") as f:
    c = f.read()
c = c.replace("logo-kerja", "logo-sertifikasi")
with open("resources/js/Pages/Content/CertificationLogo/CertificationLogoForm.vue", "w") as f:
    f.write(c)
