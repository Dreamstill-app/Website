(function () {
  const canvas = document.getElementById('hero-canvas');
  if (!canvas || typeof THREE === 'undefined') return;

  const scene = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 100);
  camera.position.z = 8;

  const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
  renderer.setSize(window.innerWidth, window.innerHeight);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

  const ambient = new THREE.AmbientLight(0xf5f0e8, 0.4);
  scene.add(ambient);

  const pointLight = new THREE.PointLight(0xc9a84c, 1.2, 20);
  pointLight.position.set(3, 4, 5);
  scene.add(pointLight);

  const pointLight2 = new THREE.PointLight(0x6b7c5e, 0.8, 20);
  pointLight2.position.set(-4, -2, 3);
  scene.add(pointLight2);

  const geometries = [
    new THREE.TorusKnotGeometry(0.6, 0.2, 100, 16),
    new THREE.IcosahedronGeometry(0.7, 0),
    new THREE.BoxGeometry(0.9, 0.9, 0.9),
    new THREE.TorusKnotGeometry(0.5, 0.15, 80, 12),
    new THREE.IcosahedronGeometry(0.5, 1),
    new THREE.BoxGeometry(0.7, 0.7, 0.7),
    new THREE.TorusKnotGeometry(0.4, 0.12, 64, 8)
  ];

  const colors = [0xc9a84c, 0x6b7c5e, 0xc4714a, 0xc9a84c, 0x6b7c5e, 0xc9a84c, 0x6b7c5e];
  const meshes = [];

  geometries.forEach((geo, i) => {
    const mat = new THREE.MeshStandardMaterial({
      color: colors[i],
      metalness: 0.3,
      roughness: 0.6,
      wireframe: false
    });
    const mesh = new THREE.Mesh(geo, mat);
    const angle = (i / geometries.length) * Math.PI * 2;
    const radius = 3 + (i % 3) * 0.8;
    mesh.position.set(
      Math.cos(angle) * radius,
      Math.sin(angle * 0.7) * 2,
      Math.sin(angle) * radius - 2
    );
    mesh.userData.speedX = 0.002 + i * 0.0008;
    mesh.userData.speedY = 0.003 + i * 0.0005;
    scene.add(mesh);
    meshes.push(mesh);
  });

  function animate() {
    requestAnimationFrame(animate);
    meshes.forEach(m => {
      m.rotation.x += m.userData.speedX;
      m.rotation.y += m.userData.speedY;
    });
    renderer.render(scene, camera);
  }
  animate();

  window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
  });

  if (typeof gsap !== 'undefined') {
    const words = document.querySelectorAll('.hero-content h1 .word');
    if (words.length) {
      gsap.fromTo(words,
        { opacity: 0, y: 80 },
        { opacity: 1, y: 0, duration: 1.1, ease: 'power3.out', stagger: 0.12, delay: 0.3 }
      );
    }
  }
})();
